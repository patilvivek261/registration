<?php
/*
 * 
 */

namespace App\Models;
use CodeIgniter\Model;

/*
 * 
 */
class LoginModel extends Model{
    
    /*
     * 
     */
    public function getLoginUserData($emailLogin){
        
        if(empty($emailLogin))
        {
            return false;
        }//end if $emailLogin empty check
        else
        {
            $builder1 = $this->db->table('reg');
            $builder1->select('unq_id,titlesel,firstname,username,passw,usr_status');
            $builder1->where(['emailid'=>$emailLogin]);
            $builder1Result = $builder1->get();
            $builder1ResultArr = $builder1Result->getResultArray();
            
            if(count($builder1ResultArr) == 1)
            {
                return $builder1Result->getRow();
            }//end if check select query count
            else
            {
                return false;
            }//end else check select query count
            
        }//end else $emailLogin empty Check
        
    }//end function getLoginUserData()
    
}//end class LoginModel

?>
