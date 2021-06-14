<?php 
/**
 * 
 */
namespace App\Controllers;
use CodeIgniter\Controller;

class ServicesController extends Controller{
    
    function __construct(){
        
        helper(['url','text','form']);
        
    }//end function __constructor()

    public function services(){
        
        $formValidationSubscribe = [
            'email_sub'=>[
                'rules'=>'required|valid_email',
                'errors'=>[
                    'required'=>'Please enter subscription email',
                    'valid_email'=>'Entered email {value} is not a valid email',
                ]
            ]
        ];
        
        $data1 = [
            'pageTitle' => 'Services Title Controller',
            'pageHeading' =>'Services Page from Heading from Controller ',
        ];
        
        /**
         * check is form is submitted
         */
        if($this->request->getMethod()=='post')
        {
            
            if($this->validate($formValidationSubscribe))
            {
                //form submitted successfully
                
            }//end if error after form subtmit
            else 
            {
                $data1['validation'] = $this->validator;
                
            }//end else error after form submit
            
        }//end if check form submit
        else 
        {
            //form not submitted
            
        }//end else check form submit
        
        echo view("services_page.php",$data1);
        return TRUE;
        
    }//end function portfolio()

    public function _remap($method,$param1=NULL,$param2=NULL){
        
        if(method_exists($this, $method))
        {
           return $this->$method($param1,$param2);
           
        }//end if menthod_exists()
        else
        {
           return $this->portfolio();    
        }
        
    }//end function _remap()

}//end class PortfolioController

?>