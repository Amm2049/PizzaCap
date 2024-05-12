<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    // Contacts Page
    public function servicePage(){
        $contacts = Contact::paginate(5);
        return view('admin.user.contact', compact('contacts'));
    }

    // Delete
    // public function deleteContact(Request $request){
    //     Contact::where('id', $request->userId)->delete();
    // }

    // View
    public function viewReport($id){
        $contact = Contact::where('id',$id)->first();
        return view('admin.user.report',compact('contact'));
    }

    // Reply
    public function reply($id, Request $request){
        $this->validateReply($request);
        Contact::where('id',$request->id)->update([
            'admin_reply' => $request->reply
        ]);
        return back()->with(['success'=>"Successfully sent the message."]);
    }

    private function validateReply($request){
        Validator::make($request->all(),[
            'reply' => 'required|min:5'
        ])->validate();
    }
}
