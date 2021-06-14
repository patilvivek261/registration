<?php
/**
 * 
 */
namespace app\Controllers;
use CodeIgniter\Controller;

class LoginController extends Controller{
    
    public function __construct() {
        
        helper(['form']);    
        
    }//end function __construct()
    
    public function login() {
        
        $data1 = [
                'pageTitle'=>'Login',
                'pageHeading'=>'Welcome to Login Page',
        ];
        echo view('login_page.php',$data1);
        
        return true;
        
    }//end function login()
    
    public function _remap($method, $param1=null, $param2=null){
        
        if(method_exists($this, $method))
        {
            return $this->$method($param1,$param2);
            
        }//end if method_exists()
        else
        {
            return $this->login();
            
        }//end else method_exists()
        
        return false;
        
    }//end function _remap()
    
}//end class LoginController


?>