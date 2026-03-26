<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Category;
use App\Rules\NotEmptyValue;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('index', compact('categories'));
    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request->only(['last_name','first_name', 'gender', 'email', 'tel_first', 'tel_middle', 'tel_last', 'address', 'building', 'detail']);
        $category = Category::find($request->input('category'));

        $validated = $request->validate([
            'category' => ['required', new NotEmptyValue],
        ]);

        return view('confirm', compact('contact', 'category'));
    }

    public function thanks(Request $request)
    {
        if ($request->has('edit')) {
            return redirect('/')->withInput($request->all());
        }

        $tel = $request->input('tel_first') . $request->input('tel_middle') . $request->input('tel_last');

        $category_id = Category::where('content', $request->input('category'))->value('id');

        $contact = array_merge($request->only(['last_name','first_name', 'gender', 'email', 'address', 'building', 'detail','category']),[
            'tel' => $tel,
            'category_id' => $category_id,
        ]);
        Contact::create($contact);
        return view('thanks');
    }

    public function export(Request $request)
    {
        // 1. 検索条件を反映させてクエリを作成
        $query = Contact::query()->with('category');

        // 名前検索（姓または名に一致）
        if ($request->filled('fullname')) {
            $query->where(function($q) use ($request) {
                $q->where('last_name', 'like', '%' . $request->fullname . '%')
                ->orWhere('first_name', 'like', '%' . $request->fullname . '%');
            });
        }

        // 性別検索
        if ($request->filled('gender')) {
            $genderValue = $request->gender;
            
            // 「全て（選択なし）」を 0 や空文字で扱っている場合は除外
            if ($genderValue != '0' && $genderValue != '') {
                $query->where('gender', $genderValue);
            }
        }

        // カテゴリ検索
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // キーワード検索（メールアドレスなど）
        if ($request->filled('keyword')) {
            $query->where('email', 'like', '%' . $request->keyword . '%');
        }

        // 絞り込んだデータを取得
        $contacts = $query->get();

        // --- ここから下（StreamedResponseの部分）は前回のコードと同じ ---
        $csvHeader = ['お名前', '性別', 'メールアドレス', '電話番号', '住所', '建物名', 'お問い合わせの種類', 'お問い合わせ内容'];

        return new StreamedResponse(function () use ($csvHeader, $contacts) {
            $handle = fopen('php://output', 'w');
            fputs($handle, chr(0xEF) . chr(0xBB) . chr(0xBF)); // BOM
            fputcsv($handle, $csvHeader);

            foreach ($contacts as $contact) {
                $gender = $contact->gender;
                $tel = $contact->tel_first . '-' . $contact->tel_middle . '-' . $contact->tel_last;

                fputcsv($handle, [
                    $contact->last_name . ' ' . $contact->first_name,
                    $gender,
                    $contact->email,
                    $tel,
                    $contact->address,
                    $contact->building,
                    $contact->category->content ?? '',
                    $contact->detail,
                ]);
            }
            fclose($handle);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="contacts_search_' . date('Ymd') . '.csv"',
        ]);
    }
}