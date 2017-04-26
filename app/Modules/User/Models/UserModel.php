<?php

namespace App\Modules\User\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use DateTime;
use Carbon\Carbon;

class UserModel extends Model
{
     
      /*this function will retrive all users information
        *@return array $users
        */
        public function viewUsers() {
            $roleTypeUser = 2;
            $users = DB::table('users')
                         ->join('role','users.role_id','=','role.id')
                         ->select('users.*','role.role')
                         ->where('role_id','!=',$roleTypeUser)
                         ->simplePaginate(3);
                         //->get();
            return $users;
        }

       /*this function will retrives the user infromation from db 
        *@param $id
        *@return array $users
        */
        public function getUsersInofrmationById($id) {
            $users = DB::table('users')

                       ->select('users.*')
                       ->where('id','=',$id)
                       ->get();
            return $users;        
        } 

       /*this function will retrives the role from db
       * @returns array $role
       */
       public function getRoles() {
           $roleTypeUser = 2;
           $role = DB::table('role')
                     ->select('role.role')
                     ->where('role.id','!=',$roleTypeUser)
                     ->get();
           return  $role;
       }


        /*this function will retrives all non testable device from db
         *@return array @asset   
          */
       public function getAllAvailableAsset() {
           $asset = DB::table('assetInformation')
                      ->select('assetInformation.*')
                      ->where('status','=','available')
                     ->get();
           return $asset;
       }


       /*this function will retrives values from userHasAsset table 
        *@param $user_id 
        *@return array $result 
        */
        public function checkUserHasAssetByUserId($user_id) {
            $result =   DB::table('userHasAsset')
                            ->select('userHasAsset.assetInformation_id')
                            ->where('user_id','=',$user_id)
                            ->get();
            return $result;               

        }

        /*this function will stroes values in userHasASSET table 
         *@param $user_id,$assetInformation_id 
         *@return boolean true 
         */
         public function storeValuesInUserHasAsset($user_id,$assetInformation_id) {
              $result = DB::table('userHasAsset')
                            ->insert(['user_id'=>$user_id,
                                     'assetInformation_id'=>$assetInformation_id]);
              return true;                       

         }


          /*this function will update the status to assigned  of assetInformation  table
         *@param $id 
         *@return bool true
         */
         public function updateAssetInofrmationStatusById($id) {
             $result = DB::table('assetInformation')
                          ->where('id','=',$id)
                           ->update(['status'=>'assigned']);
             return true;              
         }
       
        

        /*this function will update the user information 
          *@param $input 
        */
        public function edit($input) {
            $result = DB::table('users')
                          ->where('id', $input['user_id'])
                          ->update(['name' =>$input['name'],
                                   'employee_id'=>$input['userid'],
                                   'email'=>$input['email'],
                                    'isleaseout'=>$input['role'],]);
            return true;
         }                            
            
    
        
        /*this function will retrives the user asseet information 
         *returns array $userassets
         */
          public function getUserAssetInformationById($id) {
                $userassets = DB::table('userHasAsset')
                             ->join('users','users.id','=','userHasAsset.user_id')
                             ->join('assetInformation','assetInformation.id','=','userHasAsset.assetInformation_id')
                             ->join('assetType','assetType.id','=','assetInformation.assetType_id')
                             ->select('users.*','assetInformation.*','assetType.*')
                             ->where('userHasAsset.user_id','=',$id)
                             ->get();
                  
                if (count($userassets)==0) {
                    return  false;
                } else {
                    return $userassets;
                 }                
           }

          /*this function will delete users information from userHasAsset table 
           *@param $user_id 
           *@return string true 
           */
           public function deleteUserHasAssetByUserId($user_id) {
                DB::table('userHasAsset')
                    ->where('user_id','=',$user_id)
                    ->delete();
                return "true";   
           }

           /*this function will delete user information from userhasrole table 
            *@param $user_id 
            *@return string true 
            */
            public function deleteuserhasRoleByUserId($user_id) {
                 DB::table('userHasRole')
                     ->where('user_id','=',$user_id)
                     ->delete();
                 return "true";    
            }


          /*this function will delete user information from db 
           *@param $id 
           *@return string $result
           */
           public function deleteUsersInformationById($id) {
                DB::table('users')
                    ->where('id','=',$id)
                     ->delete();

             return "true";
           }


           /*this function will retrives asset information which all are available and 
             *testable devices
             *@returns array @asset to leaseout screen   
             */
          public function getAllAvailableAndTestableAsset() {

              $isTestable =1;
              $asset = DB::table('assetInformation')
                             ->distinct()
                             ->leftjoin('leaseOutAssetInformation','leaseOutAssetInformation.assetInformation_id','=','assetInformation.id')
                             ->select('assetInformation.*','assetInformation.status')
                             ->where([ ['assetInformation.status', '=', 'available'],
                                      ['assetInformation.is_Testable', '=',  $isTestable],])        
                            ->get();          
             return $asset;
  
         }


          /*this function wil retrives the leaseoutassetINformation  details
           *@return $result to the leaseoutdetails view
          */
          public function getLeastOutDetails() {
               $result = DB::table('leaseOutAssetInformation')
                             ->join('users','users.id','=','leaseOutAssetInformation.user_id')
                             ->join('assetInformation','assetInformation.id','=','leaseOutAssetInformation.assetInformation_id')
                             ->select('*','leaseOutAssetInformation.id','leaseOutAssetInformation.status')
                             ->get();
               return $result;       
         }


         /*this function will retrive data  from leaseoutassetinformation table 
          * for purpose of getting status and showing screen on status
         *@param $user_id
         *@return the array $result to the leaseoutscreen view
         */
         public function getLeaseOutDetailsByUserId($user_id) {
              $result = DB::table('assetInformation')
                            ->distinct()
                            ->join('leaseOutAssetInformation','assetInformation.id','=','leaseOutAssetInformation.assetInformation_id')
                            ->select('*','leaseOutAssetInformation.id','assetInformation.status')
                            ->where([['leaseOutAssetInformation.user_id','=',$user_id], ])
                            ->get(); 
              return $result;
         }



       /*this function will update the information of leaseoutassetinformation tabel 
       *@param $input
       *@return true or false 
       */
       public function storeLeaseOutAssetDetails($input) {
            $result = DB::table('leaseOutAssetInformation')
                          ->insert(['user_id'=>$input['user_id'],
                                   'assetInformation_id'=>$input['assetinformation_id'],
                                   'taken_time'=>$input['taken_time'], ]);
            return $result;        
      }

      /*this will update the status of the leaseoutassetInformation table 
       */
      public function updateLeaseOutInformationStatus($input)  {
            $result = DB::table('leaseOutAssetInformation')
                          ->where('id','=',$input['leaseout_id'])
                         ->update(['status'=>$input['status']]);
           return $result;
      }

               
     /*this will update the status of the assetInformation table 
     */
      public function updateAssetInformationStatus($input) {
           $result = DB::table('assetInformation')
                         ->where('id','=',$input['asset_id'])
                         ->update(['status'=>$input['status']]);
           return $result;
      }

      /*this will update the status of the assetInformation table 
       */
       public function updateAssetInformationStatusById($id) {
            $result = DB::table('assetInformation')
                          ->where('id','=',$id)
                          ->update(['status'=>'requested']);
           return $result;
       }

      /*this will update the return time from leaseoutassetinformation table 
       */
      public function updateLeaseOutAssetDetails($input) {
             $result = DB::table('leaseOutAssetInformation')
                           ->where('id','=',$input['id'])
                          ->update(['return_time'=>$input['return_time']] );
                     
            return $result;
      }

      /*this function wil retrives the leaseoutassetINformation  details
       *@param $id
       *@return $result to the leaseoutdetails view
       */
       public function getLeaseOutDetailsById($id) {
            $result = DB::table('leaseOutAssetInformation')
                          ->join('users','users.id','=','leaseOutAssetInformation.user_id')
                          ->join('assetInformation','assetInformation.id','=','leaseOutAssetInformation.assetInformation_id')
                          ->select('*','leaseOutAssetInformation.id')
                          ->where('leaseOutAssetInformation.id','=',$id)
                         ->get();
           return $result;       
       }

      /*this function will update the userprofile to add iamge filename
       */
       public function updateUserProfile($filename,$id) {
             DB::table('users')
                 ->where('id','=',$id)
                 ->update(['image'=>$filename]);

            return true;
      }
}    
?>