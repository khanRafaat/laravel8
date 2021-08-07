<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\ContactForm;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;

class ContactController extends Controller{

public function AdminContact(){
$contacts = Contact::latest()->get();
return view('admin.contact.index',compact('contacts'));
}

public function AdminAddContact(){

return view('admin.contact.create');
}

public function AdminStoreContact(Request $request){
Contact::insert([
'address'=> $request->address,
'phone'=>  $request->phone,
'email' => $request->email,
'created_at' => Carbon::now()]);

$notification =array(
'message'=>'Contact insert Successfully',
'alert-type'=>'success',
);
return Redirect()->route('admin.contact')->with($notification);
}

public function EditAdminContact($id){
$getdata =Contact::find($id);
return view('admin.contact.edit',compact('getdata'));
}

public function AdminContactUpdate(Request $request,$id){
    $update= Contact::find($id)->update([
        'address'=>$request->address,
        'email'=>$request->email,
        'phone'=>$request->phone
]);

$notification =array(
'message'=>'Contact Update Succesfully',
'alert-type'=>'info',
);
return Redirect()->route('admin.contact')->with($notification);

}



public function DeleteAdminContact($id){

$delete = Contact::find($id)->delete();

$notification =array(
'message'=>'Contact Delete Successfully',
'alert-type'=>'error',
);
return Redirect()->back()->with($notification);
}

public function Contact(){
$contact = Contact::latest()->first();
return view('pages.contact', compact('contact'));

}

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
