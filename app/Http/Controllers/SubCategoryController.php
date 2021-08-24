<?php

namespace App\Http\Controllers;

use App\Category;
use App\SubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubCategoryController extends Controller {

	function __construct() {
		return $this->middleware('verified');
	}

	function SubCategory() {

		$categories = Category::orderBy('category_name', 'asc')->get();

		return view('backend.subcategory.subcategory', compact('categories'));
	}
	function SubCategoryPost(Request $request) {

		SubCategory::insert([
			'subcategory_name' => $request->subcategory_name,
			'category_id' => $request->category_id,
			'created_at' => Carbon::now(),

		]);

		return back()->with('success', 'Sub Category Added Successfully!');
	}
	function SubCategoryView() {
		$scount = SubCategory::count();
		$subcategories = SubCategory::with('get_category')->paginate(5);

		return view('backend.subcategory.view_subcategory', compact('subcategories', 'scount'));
	}

//Soft delete Start

	function SubCategoryDelete($id) {

		SubCategory::findOrFail($id)->delete();

		return back();
	}

	function SubCategoryDeleted() {
		$scount = SubCategory::onlyTrashed()->count();

		$subcategories = SubCategory::onlyTrashed()->latest()->paginate(5);

		return view('backend.subcategory.deleted_subcategory', compact('subcategories', 'scount'));

	}

	function SubCategoryRestore($id) {

		SubCategory::withTrashed()->findOrFail($id)->restore();

		return back()->with('Restore', 'Data Restored Successfully!');
	}
	function SubCategoryPermanentDelete($id) {
		SubCategory::withTrashed()->findOrFail($id)->forceDelete();

		return back()->with('Delete', 'Data Permanently Deleted Successfully!');
	}

	function SubCategoryEdit() {

		return view('backend.subcategory.');
	}
	function SubCategoryUpdate() {

		return view('backend.subcategory.');
	}

}
