<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Carbon\Carbon;

use function GuzzleHttp\Promise\all;

class CategoryController extends Controller
{
    function __construct()
    {
        return $this->middleware('verified');
    }

    function category(){


        return view('backend.category');

    }


    function categoryPost(Request $request){

      // form validation

      $request->validate([
      'category_name'=>(['required','unique:categories','min:3'])
      ]);

        // $cat= new $category;
        // //database filed name = form input name
        // $cat->category_name = $request->name;
        // $cat->save();

        // return $request->name;
        category::insert([
        'category_name'=>$request->category_name,
        "created_at"=>Carbon::now()
        ]);

        return back()->with('success','Category Added Successfully!');
    }

    function categoryView(){

        $category= Category::orderby('category_name','asc')->paginate(5);

        return view('backend.view_category',compact('category'));
    }

    function categoryDelete($id){

        //findorfail function work only id
        //where function work only id or name

        Category::findorFail($id)->delete();
        //Category::Where('id',$id)->delete();

        return back()->with('delete','Category Deleted Successfully!');
    }

    function categoryEdit($id){

        $category = Category::findorFail($id);
        return view('backend.edit_category',compact('category'));
    }
    function categoryUpdate(Request $request){
        $id= $request->category_id;
        Category::findOrFail($id)->update([
        'category_name'=> $request->category_name,

        ]);

        return redirect('/view-category-list')->with('update','Category Updated Successfully!');
    }

}
