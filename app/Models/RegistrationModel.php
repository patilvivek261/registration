<?php
/*
 * 
 */
namespace App\Models;
use CodeIgniter\Model;

/*
 * 
 */
class RegistrationModel extends Model{
    
    public function registerUser($regData=null){
        
        if(empty($regData))
        {
            return false;
        }//end if user data exists
        else
        {
            $insRowObj = $this->db->table('reg');
            $insCnt = $insRowObj->insert($regData);
            if($this->db->affectedRows()==1)
            {
                return true;            
            }//endif affectedrow check
            elseif($this->db->affectedRows()>1)
            {
                return false;
            }//end elseif affected row check
            else
            {
                return false;    
            }//end else affected row check
                    
        }//end else user data exist
        
    }//end function registerUser()
    
    public function getUserActivationData($activationCd){
        
        if(empty($activationCd))
        {
            return false;
        }//end if activation code check for exist
        else
        {
            $selQrObj = $this->db->table('reg');
            $selQrObj->select('unq_id','titlesel','firstname','emailid','activation_date_time');
            $selQrObj->where(['activation_cd'=>$activationCd]);
            $selQrObjResult = $selQrObj->get();
            if($selQrObj->countAll()==1)
            {
                return $selQrObjResult->getRow();
            }//end if check fetched rows
            else
            {   
                return false;
            }//end else check fetched rows
            
        }//end else activation code check for exist
        
    }//end funcation activateUser
    
}//end class RegistrationModel

?>