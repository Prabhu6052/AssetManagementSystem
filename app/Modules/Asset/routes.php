<?php
use Illuminate\Support\Facades\View;
//use View;

      Auth::routes();

      Route::get('/home', 'HomeController@index');

     /*inside this middleware all routes will execute except those routes belongs other middleware 
       */ 
       Route::group(['middleware' => ['web']], function () {

       /*this route will provides the index page and request is sending to 
        * the assetController index function
         */
        Route::get('/','App\Modules\Asset\Controllers\AssetController@index');


         /*this route will provides the profile view of users
          */
        Route::get('/profile','App\Modules\User\Controllers\UserController@profile');  
   
        /*this route will stores the profile data to database 
         */
        Route::post('/profiles','App\Modules\User\Controllers\UserController@updateProfile') ; 

  
     /*inside this middleware all Admin related routes will execute
      */
     Route::group(['middleware' => 'admin'], function() 
     {
       /*this route will go to admincontroller controller  @getadminview function
       */
       Route::get('/admin', 'App\Modules\User\Controllers\UserController@getAdminView');


       /*asset new creating view page
        * sset view page and sending to assetcontroller
        */
       Route::get('/asset/create','App\Modules\Asset\Controllers\AssetController@view');


       /*asset storing to the asset information 
        *storing the values of asset in databse so sending to assetcontroller
        */
       Route::post('/asset/add', 'App\Modules\Asset\Controllers\AssetController@add');
       

       
      /*retriving asset information for updating
         *@param is int $id
         *sending to the assetController readById function
         */ 
      // Route::get('/asset/view/{id}','App\Modules\Asset\Controllers\AssetController@showById');
         Route::get('/asset/view/','App\Modules\Asset\Controllers\AssetController@showById'); 

        /*updating the asset information
         * sending to the assetcontroller update function
         */
       Route::post('asset/update','App\Modules\Asset\Controllers\AssetController@update');

       /*deleting the asset information 
        *@parm is $id
        *sending to the assetcontroller delete function
       */ 
       Route::get('asset/delete', 'App\Modules\Asset\Controllers\AssetController@delete');


      /*this will gives the leaseoutdetails screen for admin 
       */
       Route::get('/leaseoutdetails','App\Modules\User\Controllers\UserController@getAdminLeaseOutDetailsView');
                 
      


       /* this will getts all users information
        * sennding to the usercontroller viewusers
        */
       Route::get('/usersinformation','App\Modules\User\Controllers\UserController@viewUsers');

       /*this will provides the user update screen 
         *sending to usercontroller show by id 
         */
      Route::get('/user/view/{id}','App\Modules\User\Controllers\UserController@showById');


       /*this will update user information 
        *sending to usercintroller update function
        */
      Route::post('/user/update', 'App\Modules\User\Controllers\UserController@update');


       /*this will unassign the asset from users  
        *and delete asset from assetinformation and userhas asset
         *sending to usercontroller unassignasset
         */
      Route::get('/asset/unassign/{id}','App\Modules\Asset\Controllers\AssetController@assetUnassign');
         
         /*this will delete the user information 
         */
      Route::get('/user/delete','App\Modules\User\Controllers\UserController@delete');


         /*this will show the  update view for the status of the leaseoutassetinformation  table
           */
      Route::get('/admin/leaseoutdetails/status/update/{id}',function($id) {
                 return view::make('User::leaseoutscreen')->with('id',$id);
      });

         /*this will update the status of leaseoutassetinformation table 
           */
      Route::post('/admin/leaseout/status/update','App\Modules\User\Controllers\UserController@updateStatus');
       
        
  });

/*inside this middleware all leaseout users  related routes will execute
  */
   Route::group(['middleware' => 'leaseoutuser'], function()
   {
           /*this will provides the leaseoutuser home page
            *sending to usercontroller getleasoutuserview function*/
           Route::get('/leaseoutuser', 'App\Modules\User\Controllers\UserController@getLeaseOutUserView');

          
         
         /*this will provides the leaseout screen
          */
           Route::get('/leaseoutuser/leaseoutscreen', 'App\Modules\User\Controllers\UserController@getLeaseOutScreen');

        /*this will give leaseoutASset vIEW 
         */
           Route::get('/leaseoutuser/leaseoutAssetScreen',function() {
              
           return view('User::leaseoutAssetScreen');

           });

        /*sending request to the leaseoutdetails 
          */
          Route::post('/leaseout','App\Modules\User\Controllers\UserController@storeLeaseOutAssetDetails');

       /*leaseout update view 
       */
          Route::get('/leaseoutuser/leaseoutdetails/status/update/{id}','App\Modules\User\Controllers\UserController@leaseoutUpdateScreen');

       /*sending to usercontroller for update the leaseoutassetInformation 
        */
          Route::post('/leaseoutuser/leaseout/status/update','App\Modules\User\Controllers\UserController@updateLeaseOutAssetDetails');
       
       

   });


 /*inside this middleware all user related routes will execute
  */
   Route::group(['middleware' => 'user'], function()
   {

     /*this will provides the user home page
      *sending to the getuserView function
      */
           Route::get('/user', 'App\Modules\User\Controllers\UserController@getUserView');
        
        

       });

       
});

?>
