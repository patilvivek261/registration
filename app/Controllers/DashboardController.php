<?php
/*
 * 
 */

namespace App\Controllers;
use CodeIgniter\Controller;

class DashboardController extends Controller{
    
    public $sessionObj1;
    
    public function __construct() {
        
        $this->sessionObj1 = \Config\Services::session();
        helper(['form','url']);
    }
    public function home(){
        
        $data1 = [
                 'pageTitle'=>'Dashboard Page',
                 'pageHeading'=>'You are on Dashboard page',
                 'pageBody'=>'You are on Dashboard page'            
        ];
        
        if($this->sessionObj1->has('loginUsrDataUid'))
        {
            //Session is pressent 
            
        }//end if check sessionObj
        else
        {
            return redirect()->to(base_url()."/LoginController/Login");
        }
        
        return view('dashboard_page.php',$data1);
        
    }//end function home
    
    public function logout(){
        $this->sessionObj1->remove('loginUsrDataUid');
        $this->sessionObj1->destroy();
        
        return redirect()->to(base_url()."/LoginController/login");
        
    }//end fucntion logout()
    
    function errCall(){
        
        $data1 = [
                 'pageTitle'=>'Error Page',
                 'pageHeading'=>'You are on Error page due to wrong url call',
                 'pageBody'=>'You are on Error page due to wrong url call'            
        ];
        
        return view("error_call_page.php", $data1);
    }
    
    public function _remap($method,$param1=null,$param2=null){
        
        if(method_exists($this, $method)){
            
            return $this->$method($param1,$param2);
        }//end if to check method exists
        else
        {
            return $this->errCall();
        }//end else to check method exists
        
    }//end function _rempa()
    
}//end class Dashboard


?>