<?php

namespace App\Modules\Asset\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Modules\Asset\Models\AssetModel;
use App\Http\Controllers\Controller;
use View;
use Redirect;

class AssetController extends Controller
{  

    /**index page 
     *
     * @return index view page
     */
    public function index() { 
        return View::make('Asset::index');
    }
     

    /**
     * Show the form for creating a new asset information.
     *
     * @return createAsset view page
     */
    public function view() {
        $model = new AssetModel();
        //getting all asset type from db 
        $type = $model->getAllAssetType();
        return View::make('Asset::createAsset',compact('type'));
    }


    /**
     * Store a newly created asset information in db.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return  if storage is success to assetSuccess page 
     *          else redirect to create asset page
     */
    public function add(Request $request) {
        $input = $request->all();
        $assetmodel = new AssetModel();
        $result = $assetmodel->insert($input);
        if ($result) {
            return redirect("/admin")->with('status','new asset information is successfully stored');
        } else {
            return redirect('asset/create')->with('status', ' not stored something happened!');
        }
    }


    /**
     * retrive the all asset information from db.
     *
     * 
     * @return to the assetinformation view with parameter
     *           array $read
     */
    public function read() {
        $assetmodel = new AssetModel();
        $read = $assetmodel->read();
        return View::make('Asset::assetInformation',compact('read'));

    }



    /**
     * retrive  the specified asset information from db to update asset information.
     *
     * @param  int $id 
     * @return  the assetupdate view with parameter
     *        array $asset 
     */
    public function showById(Request $request) {
        $id = $request->id;
        $assetmodel = new AssetModel();
        $asset = $assetmodel->getAssetInformationById($id);
      //  return View::make('Asset::assetUpdate', compact('asset'));
         return response()->json($asset);
    }


    /**
     * Update the asset information in db.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return  if $result is true redirecting to the assetinformation view with successfull status 
     *          else if it is redirecting to the assetinformation view with error status
     */
    public function update(Request $request) { 
        $input = $request->all(); 
        $assetmodel = new AssetModel();
        $result = $assetmodel->edit($input);
        if ($result == true) {
            return redirect('/admin')->with('status', ' updated succesfully!');
        } else  {
            return Redirect::to('/admin')->with('status', 'not  updated something went wrong!');
        }
    }


    /**
     * delete  the asset information from db by thier id.
     * before deleting the asset check if is assign to some users or not 
     * @param  int  $id
     * @return  if result is true means redirect to assetinformation view with success message
     *           else if redirect to assetinformation view with error status 
     */
    public function delete(Request $request) {
        $isassigned = "";
        $id = $request->id;
        $assetmodel = new AssetModel();
        $result = $assetmodel->getAssetInformationById($id); 
        foreach ($result as $key ) {
            $isassigned = $key->status;
        } 
        if ( $isassigned == 'assigned') {
             echo $id;
        } else { 
             $result = $assetmodel->deleteAssetInformationById($id);
             echo  "true";
        }      
    }


     /*this function WILL unassign the asset from users 
      *first we change status of assetinformation to available then delete the asset 

      *then delete the asset from assetINformation table 
           
      *@param $id
      *@return usersinformation view with status 
      */
     public function assetUnassign($id) {
          $model = new AssetModel();
          $result = $model->updateAssetInofrmationStatusById($id);
          $result = $model->deleteAssetInformationById($id);
          return redirect('/admin')->with('status', 'deleted succesfully!');  
     }  

}
