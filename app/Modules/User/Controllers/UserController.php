<?php

namespace App\Modules\User\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use View;
use App\Http\Controllers\Controller;
use Redirect;
use App\Modules\User\Models\UserModel;
use App\Modules\Asset\Models\AssetModel;
use Auth;
use Image;

class UserController extends Controller 
{  

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /*this function will give the user view page
     *@return userview page
     */
    public function getUserView() {
         $id = Auth::user()->id;
         $model = new UserModel();
         $result = $model->getUserAssetInformationById($id);
         if ( $result) {
             return View::make("User::userView",compact('result'));
         } else {
            return View::make("User::userView",compact('result'));
         }
          
    }

     /*this function will give the admin view page
     *@return adminview page
     */
    public function getAdminView() {
         $assetmodel = new AssetModel();
         $read = $assetmodel->read();
         return View::make('User::adminView',compact('read'));
    }


     /*this function will give the leaseout user view page
     *@return leaseoutuserview page
     */
    public function getLeaseOutUserView() {
         $id = Auth::user()->id;
         $model = new UserModel();
         $result = $model->getUserAssetInformationById($id);
         if ( $result) {
             return View::make("User::leaseOutUserView",compact('result'));
         }  else {
             return View::make("User::leaseOutUserView",compact('result'));
         }
    }

     /*this function will retrives the user information
      *
      *@returns the usersinformation view with array $users
      */
    public function viewUsers() {
        $model = new UserModel();
        $users  = $model->viewUsers();
        return View::make('User::usersInformation',compact('users'));
    }

    /*this function wil the calls usermodel getbyid()
    *@param $id
    *@return the userupdate viw
    */
    public function showById($id) {
        $model = new UserModel();
        $user = $model->getUsersInofrmationById($id);
        return View::make('User::userUpdateView',compact('user'));
    }


    /*this function will update the user information  and assign the asset to user 
     *And insert the information in userhasasset table in db
     *@param Request #request
     *@return userinformation 
     */
     public function update(Request $request) {
         $input = $request->all();
         $model = new UserModel();
         //insert information into userHasASeet table 
         $model->storeValuesInUserHasAsset($input['user_id'],$input['assetinformation_id']);
         //update the status of assetINformation to assigned in asetInformation table 
         $model->updateAssetInofrmationStatusById($input['assetinformation_id']);
         //update the user information 
         $model->edit($input); 
         return redirect('/usersinformation')->with('status', 'updated successfully');
     }


     /*this function will delete the users informations 
      *@param $id
      *@return true or false
      */
     public function delete(Request $request) {
          $id = $request->id;
          $model = new UserModel();
          //check wether this user has asset or not 
          $result = $model->checkUserHasAssetByUserId($id);
          //if user doesnot have asset  means  delete 
          if (count($result) == 0) {
               $res = $model->deleteUsersInformationById($id);
               echo $res;
          } else {
               /*if user has asset means first we unassigne the asset and 
                *delete users data  from userHasAsset,users and userHasrole table 
                */
                $assetinformation_id = filter_var($result, FILTER_SANITIZE_NUMBER_INT);   
                $res = $model->deleteUserHasAssetByUserId($id); 
                //delete user infromation from users 
                $res =$model->deleteUsersInformationById($id);
                //delete user from userHasRole 
                $model->deleteuserhasRoleByUserId($id); 
                //update the status of assetinformation to available 
                $assetmodel = new AssetModel();
                $assetmodel->updateAssetInofrmationStatusById($assetinformation_id) ;
                echo "true";
         }            
     }


   /*it will insert the data into leaseoutassetinformation table 
    * @param Request $request 
    * @return leaseoutuserview 
    */
     public function storeLeaseOutAssetDetails(Request $request) {
          $input =$request->all();
          $model = new UserModel();
          //update status of assetInformation 
          $user_name =Auth::user()->name;
          notify()->flash("$user_name has requested the asset!! ","success");
          $model->updateAssetInformationStatusById($input['assetinformation_id']);
          $model->storeLeaseOutAssetDetails($input);
          return redirect('/leaseoutuser/leaseoutscreen');
    }

   /*getting the admin leaseoutdetails screen 
    *return leaseoutdetails view
    */
    public function getAdminLeaseOutDetailsView() {
         return view::make('User::leaseoutdetails');
    }

   /*it will update the status in leaseoutassetinformation
    */
    public function updateStatus(Request $request) {
         $input = $request->all();
         $model = new UserModel();
         $model->updateLeaseOutInformationStatus($input);
         $model->updateAssetInformationStatus($input);
         return view::make('User::leaseoutdetails');   
            
    }

     /*this will updtae the leaseoutassetinofrmation  details 
      *@return back to the leaseoutuser view 
      */
    public function updateLeaseOutAssetDetails(Request $request) { 
        $input = $request->all();  
        $model = new UserModel();
        $model->updateLeaseOutAssetDetails($input);
        return redirect('/leaseoutuser/leaseoutscreen');
    }


  /*this function will returns the profile view of users
   */
   public function profile() {
       return view::make('User::profile',array('user'=>Auth::user()));
   }


 /*this function will update the profile of users 
  */
  public function updateProfile(Request $request) {
       $user_id = Auth::user()->id;
       if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save(public_path('/uploads/images/'.$filename));
            $model = new UserModel();
            $model->updateUserProfile($filename,$user_id);
      }
      return Redirect::to('/profile'); 
  }


 /*leaseoutupdate view
  *@param $id 
  *@return array to leaseoutupdateview 
  */  
  public function leaseoutUpdateScreen($id) {
       $model = new UserModel();
       $result = $model->getLeaseoutDetailsByID($id);
       return view::make('User::leaseOutUpdateView',compact('result'));
  }


  /*this function shows the leaseoutscreen view 
   *@return leaseoutscreen view 
   */
   public function getLeaseOutScreen() {
        
        return view('User::leaseoutscreen');
   }
}
