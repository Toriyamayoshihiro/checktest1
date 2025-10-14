<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Category;

class ContactController extends Controller
{
    public function index()
    {

        $categories =Category::all();
        return view('index',compact('categories'));
    }
    public function confirm(ContactRequest $request)
    {
        
        $tel = $request->input('tel1'). $request->input('tel2'). $request->input('tel3') ;
        $contact = $request->only([
            'first_name','last_name','gender','email','address','building','category_id','detail'
        ]);
        $contact['tel'] = $tel;
        $category =Category::find($contact['category_id']);
        return view('confirm',compact('contact','category'));
    } 
    public function store(Request $request)
    {
        $contact = $request->only([
          'first_name' ,
            'last_name',
            'gender',
            'email',
            'tel',
            'address',
            'building',
            'category_id',
            'detail'
        ]);
        if ($request ->input('action')==='back'){
            return redirect('/')->withInput();
         } 
         Contact::create($contact);
         
        return view ('thanks');
    }
    public function admin()
    {
        
        $contacts = Contact::with('category')->Paginate(7);
        $categories=Category::all();
        return view('admin',compact('contacts','categories'));
    }
    
    public function search(Request $request)
    {
       $query = Contact::query();
       $keyword = $request->keyword;
       if (!empty($keyword)) {
        $query->where(function($query)use($keyword){
               $query->where('first_name','LIKE',"%{$keyword}%")
                     ->orWhere('last_name','LIKE',"%{$keyword}%")
                     ->orWhereRaw("CONCAT(first_name,last_name)",'LIKE',["%{$keyword}%"])
                     ->orWhere('email','LIKE',"%{$keyword}%");
        });
    if(!empty($request->gender)) {
        $query->where('gender',$request->gender);
    }
    if(!empty($request->category_id)) {
        $query->where('category_id',$request->category_id);
    }
    if(!empty($request->created_at)) {
        $query->where('created_at',$request->created_at);
    }                         
    }
    $contacts = $query->with('category')->Paginate(7);
    $categories = Category::all();
    return view('admin',compact('contacts','categories'));
}
public function delete(Request $request)
{
    Contact::find($request->id)->delete();
    return redirect('/admin');
}
}
