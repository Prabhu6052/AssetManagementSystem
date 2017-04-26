<?php
use Illuminate\Support\Facades\Request;
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
//welcome page
//Route::get('/', function () {
//    return view('welcome');
//});


/*
*index page 
*sending to the usercontroller index function
*/
//Route::get('/','UserController@index'); 



/*register page
*sending to the usercontroller create function
*/ 
//Route::get('/register', function() {
  //  echo "register page";
//});


/*login page
*sending to the usercontroller login function
*/ 

//Route::get('/login', function() {
 //    echo "login page";
//});

/*asset new creating view page
* sset view page and sending to assetcontroller
*/
//Route::get('/asset/create','AssetController@create');


/*asset storing to the asset information 
*storing the values of asset in databse so sending to assetcontroller
*/
//Route::post('asset/add', 'AssetController@add');


/*reading the asset information
*sending to the assetcontroller read function
*/ 
 
//Route::get('asset/read', 'AssetController@read');


//assigning the asset to users
//Route::get('user/asset',function(){
  //  echo "assigning";
//});


/*retriving asset information for updating
*@param is int $id
*sending to the assetController readById function
*/ 
//Route::get('asset/view/{id}','AssetController@readById');


/*updating the asset information
* sending to the assetcontroller update function
*/
//Route::post('asset/update','AssetController@update');


/*deleting the asset information 
*@parm is $id
*sending to the assetcontroller delete function
*/ 
//Route::delete('asset/delete/', 'AssetController@delete');

//Route::delete('users/destroy', 'UsersController@destroy');
//Route::post('asset/delete/{id}',function($id){
  //echo "kfjk";
//});

//Route::delete('productajaxCRUD/{product_id?}',function($product_id){
  //  $product = App\Product::destroy($product_id);
   // return response()->json($product);


  // Route::get('asset/delete', 'AssetController@delete');
Auth::routes();

Route::get('/home', 'HomeController@index');
