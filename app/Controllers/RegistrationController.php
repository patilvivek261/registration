<?php
/*
 * 
 */
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\RegistrationModel;

class RegistrationController extends Controller{
    
    public $regModelObj;
    public $sessData;
    public $emailSend;
    /*
     * 
     */
    public function __construct() {
        
        $this->regModelObj = new RegistrationModel();
        $this->sessData = \Config\Services::session();
        $this->emailSend = \Config\Services::email();
        date_default_timezone_set("Asia/Kolkata");

        helper(['form','url','date']);    
        
    }//end function __construct()
  
    /*
     * 
     */
    function errCall(){
        
        $data1 = [
                 'pageTitle'=>'Error Page',
                 'pageHeading'=>'You are on Error page due to wrong url call',
                 'pageBody'=>'You are on Error page due to wrong url call'            
        ];
        
        return view("error_call_page.php", $data1);
    }
        
    /*
     * 
     */
    public function register() {
        
        $userRegisterData = [];
        
        $data1 = [
                 'pageTitle'=>'Regisrtation',
                 'pageHeading'=>'Welcome to Registration Page',    
        ];
        
        $registrationValidation = [
            'titleSal'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Please Enter Title'
                   
                ]
            ],
            'firstName'=>[
                'rules'=>'required|alpha_numeric',
                'errors'=>[
                    'required'=>'Please Enter First Name',
                    'alpha_numeric'=>'{value} is not a valid First name, only alpha numeric characters are allowed' 
                ]
            ],
            'lastName'=>[
                'rules'=>'required|alpha_numeric',
                'errors'=>[
                    'required'=>'Please Enter Last Name',
                    'alpha_numeric'=>'{value} is not a valid Last name, only alpha numeric characters are allowed'
                ]
            ],
            'mobileNo'=>[
                'rules'=>'required|numeric|exact_length[10]',
                'errors'=>[
                    'required'=>'Please Enter Mobile No.',
                    'numeric'=>'Please Enter Numeric valueee',
                    'exact_length'=>'Please Enter 10 digit Mobile Number'
                ]
            ],
            'emailId'=>[
                'rules'=>'required|valid_email|is_unique[reg.username]',
                'errors'=>[
                    'required'=>'Please Enterrr Email Address',
                    'valid_email'=>'Please Enterrrrr valid Email, {value} is not valid Email',
                    'is_unique'=>'Provided email id {value} is already registered with us'
                ]
            ],
            'passw'=>[
                'rules'=>'required|min_length[8]|max_length[20]',
                'errors'=>[
                    'required'=>'Please Enter First Name',
                    'min_length'=>'Please Enter Password more than 08 charaters',
                    'max_length'=>'Please Enter Password less than 020 Characters'
                ]
            ],
            'cpassw'=>[
                'rules'=>'required|matches[passw]|min_length[8]|max_length[20]',
                'errors'=>[
                    'required'=>'Please Enter First Name',
                    'matches'=>'Confirm password does not matches with password',
                    'min_length'=>'Please Enter Password more than 8 charaters',
                    'max_length'=>'Please Enter Password less than 20 Characters'
                ]
            ]            
            
        ];
        
        // Check if form is submitted
        if($this->request->getMethod()=='post')
        {
            //check form validation
            if($this->validate($registrationValidation))
            {
                /* Validation Success */
                $unqno = md5(str_shuffle("abcdefghijklmnopqrstuvwxyz").date("Ymdhis"));
                $activationCode= md5(str_shuffle("234567890lmnopqrstuvwxyz").date("Ymdhis"));
                
                $userRegisterData = [
                    'unq_id'=>$unqno,
                    'titlesel'=>$this->request->getVar('titleSal',FILTER_SANITIZE_STRING),
                    'firstname'=>$this->request->getVar('firstName',FILTER_SANITIZE_STRING),
                    'lastname'=>$this->request->getVar('lastName',FILTER_SANITIZE_STRING),
                    'mobileno'=>$this->request->getVar('mobileNo',FILTER_SANITIZE_NUMBER_INT),
                    'emailid'=>$this->request->getVar('emailId',FILTER_SANITIZE_EMAIL),
                    'username'=>$this->request->getVar('emailId',FILTER_SANITIZE_EMAIL),
                    'passw'=> password_hash($this->request->getVar('passw'), PASSWORD_DEFAULT), 
                    'cpassw'=>password_hash($this->request->getVar('cpassw'),PASSWORD_DEFAULT),
                    'activation_cd'=>$activationCode,
                    'activation_date_time'=> date("Y-m-d H:i:s")                    
                    
                ];    
                //print_r($userRegisterData);
                //exit;
                //model is called tostore data in database
                $statusUserReg = $this->regModelObj->registerUser($userRegisterData);
                if($statusUserReg==true)
                {
                    //data addition successful display message & send email
                    
                    $emailToName    =   $this->request->getVar('firstName',FILTER_SANITIZE_EMAIL); 
                    $emailTo        =   $this->request->getVar('emailId',FILTER_SANITIZE_EMAIL);
                    $emailSub       =   "Activate Your Account by Verifying Email Id";
                    $emailContent   =   "Dear $emailToName, <br/><br/> Thank you for registration, Please activate your account ".
                            "by verifying your email-id. <br/><br/> Please click on below link to activate your account <br/><br/>".
                            "Activation link : <a href='".base_url()."/RegistrationController/accountActivation/".
                            $activationCode."' target='_blank'>Click Here</a><br/><br/><br/> best Regards <br/> Team Admin";
                    $emailFromName  =  "IMS Conference";
                    $emailFromemailid = "conference@indiamanufacturingshow.com";
                    
                    //setting up email object parameters
                    $this->emailSend->setTo($emailTo);
                    $this->emailSend->setSubject($emailSub);
                    $this->emailSend->setMessage($emailContent);
                    $this->emailSend->setFrom($emailFromemailid, $emailFromName);
                    if($this->emailSend->send())
                    {
                        //email send successfull & account is created
                        $this->sessData->setTempdata('success',"Your registration data added to system,".
                                " Please check your registered email id for account activation link ",3);
                        return redirect()->to(current_url());
                        
                    }//endif email send
                    else
                    {
                        // email sending failed but account is created
                        $emailSendingFailed = array($this->emailSend->printDebugger(['headers']));                        
                        //log_message('error', 'Failed Email sending to $emailTo', $emailSendingFailed);
                        $this->sessData->getTempdata('error','Your registration information added to the'.
                                'system but failed tosend account activation link to your email $emailTo ',3);
                        
                        return redirect()->to(current_url());
                        
                    }//end else email send
                    
                    
                }//end if user reg data addition status check
                else
                {
                    //display data addition failed message
                    $this->sessData->setTempdata('error','User Data Addition Failed, please try again',3);
                    return redirect()->to($currnt_url());
                    
                }//end else user reg data addition status check
                
            }//endif form validation
            else
            {
                //error in validation                
                $data1['validation'] = $this->validator;
                                
            }//end else form validation
            
            
        }//end if form post checking
        else
        {
            
        }//end else form checking
        
        echo view('registration_page.php',$data1);
        
        return true;
        
    }//end function login()
    
    /*
     * 
     */
    function accountActivation($activationCd){
        
         $dataActivationMsg = [
                 'pageTitle'=>'Registration Account Activation',
                 'pageHeading'=>'Welcome to Account Activation Page',    
        ];
        
        if(empty($activationCd))
        {
            //account activation code is empty so account activation failed
            $dataActivationMsg['error'] = "Account activation details unavailable";
        }
        else
        {
            //account activation code is present to process next steps
            
            //check account activation code is exist in database & valid
            $userAccActCdData = $this->regModelObj->getUserActivationData($activationCd);
                        
            if($userAccActCdData)
            {                          
                //check account is already activated
               if($userAccActCdData->usr_status == "Active")
               {
                   $dataActivationMsg['error'] = "User Account is already active";
                   
               }//end if check user is already active or not
               else if($userAccActCdData->usr_status == "InActive")
               {
                   //check account activation code is expired (60 min limit)
                   $userAccActTs = strtotime($userAccActCdData->activation_date_time);
                   $currdttm = strtotime(date("Y-m-d H:i:s"));
                   
                   //echo "<br/>:".date("Y-m-d H:i:s").": ".$userAccActTs." :$userAccActCdData->activation_date_time: ".$currdttm."<br/> ".(int)($currdttm-$userAccActTs);
                   //exit;
                   if((int)($userAccActTs-$currdttm) > 3600)
                   {
                       //60min over so activation code is expired
                       $dataActivationMsg['error'] = "Account activation Code is expired";                  
                       
                   }//end if check 60min activation link status
                   else
                   {
                       //all activation code passed so activate user account
                       $userActivationProcessStatus = $this->regModelObj->activateUserRegistration($activationCd);
                      
                       if($userActivationProcessStatus)
                       {
                           //Activate account
                           $dataActivationMsg['success'] = "User Account Activation Successful";                  
                      
            
                           
                       }//end if status check user activation process
                       else
                       {
                            $dataActivationMsg['error'] = "Account activation process Failed";                  
                      
                       }//end else status check user activation process
                       
                   }//end else check 60min activation link status
                   
               }//end elseif check user is already active or not
               else
               {
                    $dataActivationMsg['error'] = "User Account Status is Ambiguous ";

               }//end else check user is already active
                                                
            }
            else
            {
                $dataActivationMsg['error'] = "Incorrect Activation Code";
            }
                         
        }
        
        return view("acc_act_page.php",$dataActivationMsg);
        
    }//end function accountActivation()
    
    public function _remap($method, $param1=null, $param2=null){
        
        if(method_exists($this, $method))
        {
            return $this->$method($param1,$param2);
            
        }//end if method_exists()
        else
        {
            return $this->errCall();
            
        }//end else method_exists()
        
        return false;
        
    }//end function _remap()
    
}//end class LoginController

?>