<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail;
use App\Mail\promotionalMail;


class CustomerController extends Controller
{

    function CustomerPage():View{
    return view('pages.dashboard.customer-page');
    }

    public function CustomerCreate(Request $request){
        $user_id=$request->header('id');
        return Customer::create([
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'mobile'=>$request->input('mobile'),
            'address'=>$request->input('address'),
            'user_id'=>$user_id
        ]);
    }

    function CustomerList(Request $request){
        $user_id=$request->header('id');
        return Customer::where('user_id',$user_id)->get();
    }


    function CustomerDelete(Request $request){
        $customer_id=$request->input('id');
        $user_id=$request->header('id');
        return Customer::where('id',$customer_id)->where('user_id',$user_id)->delete();
    }

    function customerByID(Request $request){
        $customer_id=$request->input('id');
        $user_id=$request->header('id');
        return Customer::where('id',$customer_id)->where('user_id',$user_id)->first();
    }



    function CustomerUpdate(Request $request){
        $customer_id=$request->input('id');
        $user_id=$request->header('id');
        return Customer::where('id',$customer_id)->where('user_id',$user_id)->update([
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'mobile'=>$request->input('mobile'),
            'address'=>$request->input('address'),
        ]);
    }
public function emailCampaignForm(){
    return view('pages.dashboard.email_campaign');

}

    public function sendPromotionalEmails(Request $request)
    {
        $request->validate([
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);
        
        $customerEmails = Customer::pluck('email')->toArray();

        $subject = $request->input('subject');
        $message = $request->input('message');


        foreach ($customerEmails as $email) {
            Mail::to($email)->send(new promotionalMail($subject, $message ));
        }

        return response()->json(['message' => 'Welcome emails sent successfully']);
    }
}