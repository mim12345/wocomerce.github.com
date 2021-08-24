<?php

use App\Category;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Auth::routes();
Auth::routes(['verify' => true]);

//Midlware Group
Route::group(['middleware' => ['web']], function () {

//Category Route
    Route::get('/add-category','CategoryController@category');
    Route::post('/add-category-post','CategoryController@categoryPost');
    Route::get('/view-category-list','CategoryController@categoryView');
    Route::get('/delete-category/{cat_id}','CategoryController@categoryDelete');
    Route::get('/edit-category/{cat_id}','CategoryController@categoryEdit');
    Route::post('/update-category-post','CategoryController@categoryUpdate');

    //SubCategory Route
    Route::get('/add-subcategory','SubCategoryController@SubCategory');
    Route::post('/add-subcategory-post','SubCategoryController@SubCategoryPost');
    Route::get('/view-subcategory-list','SubCategoryController@SubCategoryView');
    Route::get('/delete-subcategory/{cat_id}','SubCategoryController@SubCategoryDelete');
    Route::get('/edit-subcategory/{cat_id}','SubCategoryController@SubCategoryEdit');
    Route::post('/update-subcategory-post','SubCategoryController@SubCategoryUpdate');
    Route::get('/Deleted-subcategory','SubCategoryController@SubCategoryDeleted');
    Route::get('/Restore-subcategory/{cat_id}','SubCategoryController@SubCategoryRestore');
    Route::get('/Permanent-Deleted-subcategory/{cat_id}','SubCategoryController@SubCategoryPermanentDelete');

    //Product Route
    Route::get('/add-product','ProductController@product');
    Route::post('/add-product-post','ProductController@productPost');
    Route::get('/view-product-list','ProductController@productView');
    Route::get('/edit-product/{pro_id}','ProductController@productEdit');
    Route::post('/update-product-post','ProductController@productUpdate');
    Route::get('/delete-product/{pro_id}','ProductController@productDelete');





    Route::get('/customer/Dashboard', 'CustomerController@index')->name('CustomerDashboard');
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/', 'FrontendController@FrontPage')->name('FrontPage');


    Route::get('/checkout', 'CheckoutController@checkout')->name('checkout');
    Route::get('/api/get-state-list/{country_id}', 'CheckoutController@GetStateList')->name('GetStateList');
    Route::get('/api/get-city-list/{state_id}', 'CheckoutController@GetCityList')->name('GetCityList');
    Route::post('/payment', 'PaymentController@Payment')->name('Payment');

//end midlware
});
//end midlware

    Route::get('/admin/Dashboard', 'AdminController@index')->name('AdminDashboard');

//With Out Midleware Group

    Route::get('/item/{slug}', 'FrontendController@SingleProduct')->name('SingleProduct');
    Route::get('/shop', 'FrontendController@Shop')->name('Shop');
    Route::get('/single-cart{slug}', 'FrontendController@SingleCart')->name('SingleCart');
    Route::get('/cart', 'CartController@cart')->name('cart');
    Route::get('/cart/{coupon}', 'CartController@cart')->name('CouponCart');

    Route::get('/single/cart-delete{id}', 'CartController@SingleCartDelete')->name('SingleCartDelete');
    Route::post('/cart/update', 'CartController@CartUpdate')->name('CartUpdate');
