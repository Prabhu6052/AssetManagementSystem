<?php

namespace App\Modules\Asset\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AssetModel extends Model
{

   /**this function will gives all asset type from db.
    *
    *@return array $assetype   to the createasset view 
    */
   public function getAllAssetType() {
       $assetType = DB::table('assetType')
                        ->select('assetType.*')
                        ->get();
       return $assetType;
   }

   /**this function will gives all role  from db.
    *
    *@return array $role  
    */
   public function getAllRole() {
       $role = DB::table('role')
                        ->select('role.*')
                        ->get();
      return $role;
   }



    /**
     * inserting the asset information to the db.
     * @param array $input
     * 
     * @return success if inserted successfuly 
     *           else not succes
     */
    public  function insert($input) {
       $result ="";
       if (isset($input)) {  
           $result = DB::table('assetInformation')->insert(['assetType_id'=>$input['assetType_id'],
                        'asset_name'=>$input['name1'],
                        'os'=>$input['os1'],
                        'processor'=>$input['processor'],
                        'is_Testable'=>$input['testing'],
                        'ram'=>$input['ram1'],'harddisk'=>$input['hd1'],
                        'sl_no'=>$input['sl_no'],
                        'status'=>"available"]);
            return true; 
       } else {
           return  false;
       }           
 
     }    
          
       
     /**
     * retriving  the asset information from the db.
     * 
     * 
     * @return array $asset 
     */  
    public function read() {
        $asset = DB::table('assetType')
                      ->join('assetInformation','assetType.id', '=', 'assetInformation.assetType_id')
                      ->select('assetType.*', 'assetInformation.*')
                      ->simplePaginate(4);
                     
        return $asset;
 
     }

     /**
     * retriving  the asset information from  the db.
     * @param int $asset_id
     * 
     * @return array $asset
     */
     public function getAssetInformationById($asset_id) {
         $asset = DB::table('assetInformation')
                      ->select('assetInformation.*')
                      ->where('assetInformation.id','=',$asset_id)
                      ->get();
         return $asset;
     }

     /**
     * updating the asset information from the db.
     * @param array $input
     * 
     * @return boolean $result
     */
    public function edit($input) {
        $result = "";
        $id = $input['asset_id'];
        $result = DB::table('assetInformation')
                      ->where('id', $id)
                      ->update(['os'=>$input['os1'],
                                'asset_name'=>$input['name1'],
                                'processor'=>$input['processor'],
                                'ram'=>$input['ram1'],'harddisk'=>$input['hd1']]);
       return true;
    }      

    /*this function will retrives the status of assetInformation table
     *@param $id 
     *@return array $result to assetcontroller delete()
      */
      public function getAssetInformationStatusById($id) {
           $result = DB::table('assetInformation')
                    ->where('id',$id)
                    ->select('assetInformation.status')
                    ->get();
           return $result;         

      }                 
       

      /**
     * deleting the asset information from the db.
     * @param int $asset_id
     * 
     * @return boolean $result
     */
      public function deleteAssetInformationById($asset_id) {
          $result = DB::table('assetInformation')
                         ->where('id', $asset_id)
                         ->delete();
         return "true";                      
      }


       /*this function will retrive all users id from user table  
        *
         *@param array @id
        */
        public function getAllUsersId() {
            $id = DB::table('users')
                     ->select('users.name')
                     ->get();
            return $id;
        }

        /*this function will update the status to available of assetInformation  table
         *@param $id 
         *@return bool true
         */
         public function updateAssetInofrmationStatusById($id) {

             $result = DB::table('assetInformation')
                          ->where('id','=',$id)
                           ->update(['status'=>'available']);
             return "true";              
         }

        





}