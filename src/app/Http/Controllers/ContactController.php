<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Category;
use App\Rules\NotEmptyValue;

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
}