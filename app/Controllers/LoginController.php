<?php
/**
 * 
 */
namespace app\Controllers;
use CodeIgniter\Controller;
use App\Models\LoginModel;

class LoginController extends Controller{
    
    public $loginModelObj1;
    public $sessionObj;
    
    public function __construct() {
        
        $this->loginModelObj1 = new LoginModel();
        $this->sessionObj = \Config\Services::session();
        helper(['form','url']);    
        
    }//end function __construct()
    
    public function login() {
        
        $data1 = [
                'pageTitle'=>'Login',
                'pageHeading'=>'Welcome to Login Page',
        ];
        echo view('login_page.php',$data1);
        
        return true;
        
    }//end function login()
    
    public function loginVerify(){
        
        $data1 = [
                'pageTitle'=>'Login',
                'pageHeading'=>'Welcome to Login Page',
        ];
        
        $loginValidation = [
            
            'email_login'=>[
                
                'rules'=>'required|valid_email',
                'errors'=>[
                    'required'=>'Please Enter Your user name / email-id',
                    'valid_email'=>'Please enter valid email-id'
                ]                
            ],
            'pass_login' =>[
                'rules'=>'required|min_length[8]|max_length[20]',
                'errors'=>[
                    'required'=>'Please enter Password',
                    'min_length'=>'Please enter valid login details',
                    'max_length'=>'Please enter Valid login details'
                ]
            ]
          
        ];
        
        if($this->request->getMethod()=='post')
        {
            if($this->validate($loginValidation))
            {
                $emailLogin = $this->request->getVar('email_login');
                $passLogin = $this->request->getVar('pass_login');
                
                $loginUserData = $this->loginModelObj1->getLoginUserData($emailLogin);
                if($loginUserData)
                {
                    //echo "<br>"."<br/>";
                    //echo "<br>".$passLogin."<br/>";
                    //echo "<br>".$loginUserData->passw."<br/>";
                    //$temps = password_hash($this->request->getVar('pass_login'), PASSWORD_DEFAULT);
                    //echo "<br/>".$temps."<br/>";
                    //if($passLogin == $temps)
                    if(password_verify($passLogin, $loginUserData->passw))
                    {
                        //login successful
                       //echo "p1";
                       //exit;
                       
                        $this->sessionObj->set('loginUsrDataUid', $loginUserData->unq_id);
                        return redirect()->to(base_url()."/DashboardController/home");
                        
                    }//end if verify password
                    else
                    {
                        //echo "p2";
                        //exit;
                        $this->sessionObj->setTempdata("error", "Invalid Login Credentialss", 3);
                        return redirect()->to(base_url()."/LoginController/login");
                        
                    }//end else verify password
                    
                }//end if login data receipt check
                else
                {
                    //no login data
                    $this->sessionObj->setTempdata("error", "Invalid Login Credentials.", 3);
                    return redirect()->to(base_url()."/LoginController/login");
                    
                }//end else login data receipt check

            }//end if check validation for login form
            else
            {
                $data1['validation'] = $this->validator;
                return view('login_page.php',$data1);
            }//end else check validation for login form


        }//end if to check post
        else
        {
            $this->sessionObj->setTempdata("error", "Form submission Error, please try again.", 3);
            return redirect()->to(base_url()."/LoginController/login");
               
        }//end else to check post

        
    }//end function 
    
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