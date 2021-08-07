<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\ContactForm;
use Illuminate\Support\Carbon;
class ContactController extends Controller{
public function AdminContact(){
$contacts = Contact::latest()->get();
return view('admin.contact.index',compact('contacts'));}
public function AdminAddContact(){
return view('admin.contact.create');}
public function AdminStoreContact(Request $request){
Contact::insert([
'address'=> $request->address,
'phone'=>  $request->phone,
'email' => $request->email,
'created_at' => Carbon::now()]);
return Redirect()->route('admin.contact')->with('success','Contact Details Inserted Succesfully');}
public function Contact(){
$contact = Contact::latest()->first();
return view('pages.contact', compact('contact'));}

public function ContactForm(Request $request){


ContactForm::insert([

'name'=> $request->name,
'email'=>  $request->email,
'subject' => $request->subject,
'message' => $request->message,
'created_at' => Carbon::now()




]);

$notification =array(
        'message'=> 'Your Messages Sent Succesfully',
        'alert-type'=> 'success'
    );

return Redirect()->route('contact')->with($notification);

}
public function AdminMessage(){

$messages =ContactForm::all();

return view('admin.contact.message', compact('messages'));

}

public  function Delete($id){

ContactForm::find($id)->delete();
return Redirect()->back()->with('success','messages deleteed Succesfully');
}

}
