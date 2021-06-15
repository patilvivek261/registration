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
           // echo $activationCd."<br/>";
            $builder1 = $this->db->table('reg');                     
            $builder1->select('id,unq_id,titlesel,firstname,emailid,activation_cd,usr_status,activation_date_time');
            $builder1->where('activation_cd',$activationCd);            
            $builder1Result = $builder1->get();
            $builder1ResultArr = $builder1Result->getResultArray();
            
            if(count($builder1ResultArr)==1)
            {
                //echo "<br/>p1<br/>";
                return ($builder1Result->getRow());
            }//end if check fetched rows
            else
            {   
                //echo "p2<br/>";
                return false;
            }//end else check fetched rows
            
        }//end else activation code check for exist
        
    }//end funcation getUserActivationData()
    
    
    public function activateUserRegistration($activationCd){
        
        if(empty($activationCd))
        {
            //echo "p1";
            return false;
            
        }//end if $activationCd empty check
        else
        {
            $updateQr = $this->db->table('reg');            
            $updateQr->where('activation_cd',$activationCd);
            $updateQr->update(['usr_status'=>'Active']);
            if($this->db->affectedRows() == 1)
            {
                //echo "p2";
                return true;
                
            }//end if affected rows update query
            else
            {   
                //echo "p3";
                return false;
                
            }//end else affected rows update query 
            
        }//end else for $activationCd empty check
        
    }//end function activateUserRegistration()
     
}//end class RegistrationModel

?>