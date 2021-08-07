<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Carbon;
use Image;
use Auth;


class HomeController extends Controller
{

   public function __construct()
   {  
        $this->middleware('auth');
     }
  

public function HomeSlider(){
$sliders = Slider::latest()->get();
return view('admin.slider.index',compact('sliders'));
    }



    public function AddSlider(){

        return view('admin.slider.create');



    }

    public function StoreSlider(Request $request){

 $slider_image = $request->file('image');
     


    // with the image intervation packge

    $name_gen= hexdec(uniqid()).'.'.$slider_image->getClientOriginalExtension();
     image::make($slider_image)->resize(1920,1088)->save('image/slider/'.$name_gen);
     $last_img ='image/slider/'.$name_gen;


    // insert information in database
Slider::insert([
'title'=> $request->title,
'description'=> $request->descriptison,
'image'=> $last_img,
'created_at'=> Carbon::now()
 ]);


    return Redirect()->route('home.slider')->with('success','Slider Inserted Succesfully');


    }


public function Edit($id){

$sliders = Slider::find($id);

return view('admin.slider.edit',compact('sliders'));


}


public function Update(Request $request, $id){

    $validatedData = $request->validate([
        'title' => 'required|min:4',
       
        
    ]);

    $old_image = $request->old_image; // taking old image path

    
// insert image and change the file name
    $slider_image = $request->file('image');

    if($slider_image){
//image intervation

     $name_gen= hexdec(uniqid()).'.'.$slider_image->getClientOriginalExtension();
     image::make($slider_image)->resize(1920,1088)->save('image/slider/'.$name_gen);
     $last_img ='image/slider/'.$name_gen;
      unlink($old_image); // remove old image
    
        // insert information in database
    
    
        Slider::find($id)->update([
         'title'=> $request->title,
         'description'=> $request->descriptison,
         'image'=> $last_img,
         'created_at'=> Carbon::now()
          ]);
         return Redirect()->route('home.slider')->with('success','Slider Update Succesfully');

    }else{

        Slider::find($id)->update([
         'title'=> $request->title,
         'description'=> $request->descriptison,
         'created_at'=> Carbon::now()
          ]);
       
         return Redirect()->route('home.slider')->with('success','Slider Update Succesfully');
        
    }

}



public function Delete($id){
$image =Slider::find($id);
$old_image = $image->image;
unlink($old_image);
Slider::find($id)->Delete();
return Redirect()->back()->with('success','Slider Delete Succesfully');




}

}
