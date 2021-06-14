<?php 
/*
 * 
 */
namespace App\Controllers;
use CodeIgniter\Controller;

class ContactController extends Controller{
    
    function __construct(){
        
        helper(['url','text','form']);
        
    }//end function __construct()
    
    public function contact(){
        
        $data1 = [
            'pageTitle'=>"Contact from Controller",
            'pageHeading'=>'Contact Page Heading'
        ];
        
        echo view("contact_page.php",$data1);
        return TRUE;
        
    }//end function about()
    
    public function _remap($method,$param1=NULL,$param2=NULL){
        
        if(method_exists($this, $method))
        {
            return $this->$method($param1,$param2);
            
        }//endif method_exists()
        else 
        {
            return $this->about();
            
        }//endelse 
        
    }//end function _remap()
    
    
}//end class AboutController


?>