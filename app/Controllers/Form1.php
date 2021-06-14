<?php 
/**
 * @author <vivek@interlinks.in>
 * @version 1.0
 * @copyright 2021-22
 * 
 */
namespace App\Controllers;

use CodeIgniter\Controller;
/*
 * 
 * @author admin
 *
 */
Class Form1 extends Controller{
    
    
    /*
     * 
     */
    function __construct(){
       
        helper(['form']);
      
    }

    /*
     * 
     */
     function  form1Check(){
        
        $data1 = [];
        
        $form1ValidationRules = [
            
            'firstName'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'XXXX Fname Required' 
                 ]
            ],
            'lastName'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Lname Required'
                ]
            ],
            'emailId'=>[
                'rules'=>'required|valid_email',
                'errors'=>[
                    'required'=>'email req',
                    'valid_email'=>'{value} is not a correct email'
                    
                ]
            ],    
            'mobileNo'=>[
                'rules'=>'required|numeric|exact_length[10]',
                'errors'=>[
                    'required'=>'mob req. baba',
                    'numeric'=>'combi. 0-9 is allowed',
                    'exact_length'=>'len-{param} must'
                ]
            ],
            'country'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'country is must'
                ]
            ],
            'gender'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Gender Required'
                ]
            ]
        ];  
        
       
       if($this->request->getMethod() == 'post')
        {
            
            
            if($this->validate($form1ValidationRules))
            {
                echo "done";
                
            }//endif validate form1
            else
            {
                
                $data1['validation'] = $this->validator;
                
            }//end else validate form1
            
            
        }//endif form1 submitted check
        else
        {
            
        }//endelse form1 submitted check
        
        return view('form1View1.php',$data1);       
        
    }//end function form1Check();
    
    
}//end class Form1

?>