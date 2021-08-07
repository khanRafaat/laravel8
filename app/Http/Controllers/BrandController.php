<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Multipic;
use Illuminate\Support\Carbon;
use Image;
use Auth;

class BrandController extends Controller
{
    // for middleware user accss control


    public function __construct(){  
        $this->middleware('auth');
     }
  

public function Allbrand(){

$brands = Brand::latest()->paginate(8);

return view('admin.brand.index',compact('brands'));

    }




    
public function StoreBrand(Request $request){

    $validatedData = $request->validate([
        'brand_name' => 'required|unique:brands|min:4',
        'brand_image' => 'required|mimes:jpg,jpeg,png',
        
    ]);




// insert image and change the file name
     $brand_image = $request->file('brand_image');
     




    // $name_gen= hexdec(uniqid());
    // $img_ext =strtolower($brand_image->getClientOriginalExtension());
    // $img_name= $name_gen.'.'.$img_ext;
    // $up_loaction='image/brand/';
    // $last_img = $up_loaction.$img_name;
    // $brand_image->move( $up_loaction,$img_name);


    // with the image intervation packge

    $name_gen= hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
     image::make($brand_image)->resize(300,200)->save('image/brand/'.$name_gen);
     $last_img ='image/brand/'.$name_gen;


    // insert information in database
    $Set_path = new Brand;
    $Set_path-> brand_name = $request->brand_name;
    $Set_path->brand_image = $last_img;
    $Set_path->save();

    $notification =array(
        'message'=> 'Brand Inserted Succesfully',
        'alert-type'=> 'success'
    );
    return Redirect()->back()->with($notification);




}

public function Edit($id){

$brands = Brand::find($id);

return view('admin.brand.edit',compact('brands'));


}

public function Update(Request $request, $id){

    $validatedData = $request->validate([
        'brand_name' => 'required|min:4',
       
        
    ]);

    $old_image = $request->old_image; // taking old image path

    
// insert image and change the file name
    $brand_image = $request->file('brand_image');

    if($brand_image){

        $name_gen= hexdec(uniqid());
        $img_ext =strtolower($brand_image->getClientOriginalExtension());
        $img_name= $name_gen.'.'.$img_ext;
        $up_loaction='image/brand/';
        $last_img = $up_loaction.$img_name;
        $brand_image->move( $up_loaction,$img_name);
    
    
        unlink($old_image); // remove old image
    
        // insert information in database
    
    
        Brand::find($id)->update([
            'brand_name' => $request->brand_name,
             'brand_image' => $last_img,
             'created_at'=> Carbon::now()
          ]);
         $notification =array(
        'message'=> 'Brand Inserted Succesfully',
        'alert-type'=> 'info'
    );
             return Redirect()->back()->with($notification);

    }else{

        Brand::find($id)->update([
            'brand_name' => $request->brand_name,
             'created_at'=> Carbon::now()
          ]);
         $notification =array(
        'message'=> 'Brand Inserted Succesfully',
        'alert-type'=> 'warning'
    );
       return Redirect()->back()->with($notification);
        
    }

}

public function Delete($id){
$image =Brand::find($id);
$old_image = $image->brand_image;
unlink($old_image);
Brand::find($id)->Delete();
 $notification =array(
        'message'=> 'Brand Delete Succesfully',
        'alert-type'=> 'error'
    );
return Redirect()->back()->with($notification);




}



//////////// This is for Multi Image upload Method\\\\\\\\

public function Multipic(){

    $images = Multipic::all();

    return view('admin.multipic.index', compact('images'));


}

public function StoreImg(Request $request){

    $validatedData = $request->validate([
        
        'image' => 'required',
        
    ]);



    $image = $request->file('image');
    


foreach($image as $images){

    // with the image intervation packge

    $name_gen= hexdec(uniqid()).'.'.$images->getClientOriginalExtension();
     Image::make($images)->resize(300,300)->save('image/multi/'.$name_gen);
     $last_img ='image/multi/'.$name_gen;


    // insert information in database
    $Set_path = new Multipic;
    $Set_path->image = $last_img;
    $Set_path->save();
}
    
    return Redirect()->back()->with('success','Image Inserted Succesfully');


}

public function Logout(){

    Auth::logout();
    return Redirect()->route('login')->with('success','User Logout');
}

}



