<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;

class AuthController extends Controller
{
    public function admin(Request $request)
    {
        $query = Contact::query()->with('category');

        if ($request->filled('fullname')) {
            $query->where(function($q) use ($request) {
                $q->where('last_name', 'like', '%' . $request->fullname . '%')
                ->orWhere('first_name', 'like', '%' . $request->fullname . '%');
            });
        }

        if ($request->filled('gender') && $request->gender != 0) {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('keyword')) {
            $query->where('email', 'like', '%' . $request->keyword . '%');
        }

        $contacts = $query->paginate(8)->withQueryString();

        $categories = Category::all();

        return view('auth.admin', compact('contacts', 'categories'));
    }

    public function search(Request $request)
    {
        $categories = Category::all();
        $contacts = Contact::with('category')
            ->categorySearch($request->input('category_id'))
            ->keywordSearch($request->input('keyword'))
            ->genderSearch($request->input('gender'))
            ->created_atSearch($request->input('created_at'))
            ->paginate(8);
        return view('auth.admin',compact('contacts','categories'));
    }

    public function delete(Request $request)
    {
        Contact::find($request->id)->delete();
        return redirect('/admin');
    }
}
