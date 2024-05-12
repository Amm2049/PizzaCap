<?php

namespace App\Http\Controllers\User;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    // Direct Contact Page
    public function contactPage(){
        $reply = Contact::first();
        return view('user.contact.contact',compact('reply'));
    }

    // Contact
    public function contact(Request $request){
        $this->validateMessage($request);
        $data = $this->getMessage($request);

        // Check if a row exists
        $existingRow = Contact::first();

        if ($existingRow) {
        // If a row exists, update it
            $existingRow->update($data);

        } else {
            // If no row exists, create a new one
            Contact::create($data);
        }

        // Contact::create($data);
        return back()->with(['success' => 'Successfully sent message.']);
    }

    private function validateMessage($request){
        Validator::make($request->all(),[
            'name' => 'required|min:5' ,
            'email' => 'required' ,
            'message' => 'required|min:5'
        ])->validate();
    }

    // Delete Reply
    public function delReply(Request $request){
        Contact::where('id', $request->contactId)->delete();
    }

    private function getMessage($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ];
    }
}
