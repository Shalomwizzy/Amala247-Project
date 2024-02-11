<?php

namespace App\Http\Controllers;

use App\Events\UserRegistered;
use App\Mail\AdminContactMail;
use App\Mail\ContactMail;
use App\Mail\ContactMailResponse;
use App\Models\User;
use App\Notifications\SendEmailToAllUsers;
use Illuminate\Http\Request;
use RegistersUsers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;

class EmailsController extends Controller
{

    public function sendContactMail(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email',
            'message' => 'required|string',
            'phone' => 'nullable|phone',
        ]);
    
        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'message' => $request->input('message'),
            'phone' => 'nullable|phone',
        ];
    
    
      
        Mail::to('support@amala247.com')->send(new ContactMail($data));
    

        $this->sendAutomaticResponse($data);
    
        return back()->with('success', 'Mail has been sent successfully. We will get in touch with you soon.');
    }
    
    
    public function sendAutomaticResponse(array $data)
    {
        Mail::to($data['email'])->send(new ContactMailResponse($data));
    }


    public function showSendEmailForm()
    {
        return view('mails.send_email_to_all_users');
    }
    
    public function sendEmailToAllUsers(Request $request)
    {
        $subject = $request->input('subject');
        $message = $request->input('message');
    
        $users = User::all();
        foreach ($users as $user) {
            $user->notify(new SendEmailToAllUsers($subject, $message));
        }
    
        return redirect()->back()->with('success', 'Email sent to all customer successfully.');
    }


}






    // public function deleteContact($email)
    // {
        
    //     $contact = Contact::where('email', $email)->first();

    
    //     if ($contact) {
           
    //         $contact->delete();

         
    //         return redirect()->back()->with('success', 'Contact form submission deleted successfully.');
    //     } else {
         
    //         return redirect()->back()->with('error', 'Contact form submission not found.');
    //     }
    // }

   

    
