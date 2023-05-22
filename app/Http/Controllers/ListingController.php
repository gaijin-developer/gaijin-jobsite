<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{

    //to show all listings 
    public function index(){

        return view('listings.index',[

            'listings'=>Listing::latest()->filter(request(['tag','search']))->paginate(8)

//            'listings'=>Listing::latest()->filter(request(['tag','search']))->get()
]);  
    }
    //to show single listing
    
    public function show(Listing $listing){
        return view('listings.show',[
            'heading'=>'Latest Listings',
            'listing'=>$listing
        ]);
    }

//show Create form
public function create(){
    return view('listings.create');
}


//store Listing Data Create form
public function store(Request $request){

//dd($request->file('logo')->store());

    $formFields= $request->validate([
        'title'=>'required',
        'company'=>['required',Rule::unique('listings','company')],
        'location'=>'required',
        'website'=>'required',
        'email'=>['required','email'],
        'tags'=>'required',
        'description'=>'required'
     ]);

     if($request->hasFile('logo')){
        $formFields['logo'] = $request->file('logo')->store('logos','public');
     }
    
     //dd(auth()->id());

     $formFields['user_id'] = auth()->id();

     Listing::create($formFields);

     //Session::flash('messsage','Listing created succesfully');

     return redirect('/')->with('message', 'Listing created succesfully');

}


//show edit form
public function edit(Listing $listing){
    
    return view('listings.edit',['listing'=>$listing]);
}

public function update(Request $request, Listing $listing){

//make sure logged in user is owner
if($listing->user_id !== auth()->id()){
    abort(403,'Unauthorized action');
}

    $formFields= $request->validate([
        'title'=>'required',
        'company'=>'required',
        'location'=>'required',
        'website'=>'required',
        'email'=>['required','email'],
        'tags'=>'required',
        'description'=>'required'
     ]);

     if($request->hasFile('logo')){
        $formFields['logo'] = $request->file('logo')->store('logos','public');
     }

     $listing->update($formFields);

     //Session::flash('messsage','Listing created succesfully');

     return back()->with('message', 'Listing updated succesfully');

}

//Delete Listing
public function destroy(Listing $listing){
    if($listing->user_id !== auth()->id()){
        abort(403,'Unauthorized action');
    }

    $listing->delete();
    return redirect('/')->with('messgae', 'listing deleted succesfully');

}

//manage listings
public function manage (){
    // dd(auth()->user()->listings()->get());
    return view('listings.manage',['listings'=>auth()->user()->listings()->get()]);
}

}
