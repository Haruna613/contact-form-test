<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Contact;
use App\Models\Category;

class AuthController extends Controller
{
    public function admin()
    {
        $contacts = Contact::with('category')->paginate(8);
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
