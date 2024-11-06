<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
       $data=$request->validate([
          'email'=>'required|email',
          'name'=>'required|string',
          'subject'=>'required',
          'message'=>'required',


       ]);
       Contact::create($data);
       return back()->with('status_message','Your Message Sent successfully');


    }
}
