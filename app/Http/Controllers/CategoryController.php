<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB; 

class CategoryController extends Controller
{

   public function __construct(){

      $this->middleware('auth');
   }


   public function AllCat(){

//****************** ORM READ Data****************************************/
      // $categories =Category::All(); data will show in last in the table

      $categories =Category::latest()->paginate(5); 
       // data will show in first in the table after insert


       $trachCat = Category::onlyTrashed()->latest()->paginate(3);





//****************************************************/



//$categories =DB::table('categories')->latest()->get(); // Query Builder Read Data



return view('admin.category.index',compact('categories','trachCat')); 

   }

   public function AddCat(Request $request){


      $validatedData = $request->validate([
         'category_name' => ['required', 'unique:categories', 'max:255'],
         
     ]);

// ***** ORM Inser Data************


   //   Category::insert([

   //    'category_name' => $request->category_name,
   //    'user_id'=> Auth::user()->id,
   //    'created_at'=> Carbon::now()
   //   ]);


// ORM Pro Methods
   $category = new Category;
   $category->category_name = $request->category_name;
   $category->user_id = Auth::user()->id;
   $category->save();

   // ******************************************


   // *** Query Builder Insert Data ***
   // $data = array();
   // $data ['category_name'] = $request->category_name; 
   // $data ['user_id'] = Auth::user()->id;
   // DB::table('categories')->insert($data);

   //**********************/

   return Redirect()->back()->with('success','Category Inserted Successfull');




   }

   public function Edit($id){


      $categories = Category::find($id);

      return view('admin.category.edit',compact('categories'));


      
   }


   public function Update(Request $request, $id){

   $update = Category::find($id)->update([


  'category_name' => $request->category_name,
   'user_id'=>Auth::user()->id


      ]);
      return Redirect()->route('all.category')->with('success','Category Updated Successfull');
   }


// trash section
   public function SoftDelete($id){

      $delete = Category::find($id)->delete();
      return Redirect()->back()->with('danger','Category Trashed Successfully');


   }

 


   public function Restore($id){

      $restore =Category::withTrashed()->find($id)->restore();
      return Redirect()->back()->with('success','Category Restored Successfully');

   }



   public function Pdelete($id){


$delete = Category::onlyTrashed()->find($id)->forceDelete();
return Redirect()->back()->with('danger','Category Permanently Successfully');

   }

}
