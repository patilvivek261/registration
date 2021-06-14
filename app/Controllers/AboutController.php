<?php 
/*
 * 
 */
namespace App\Controllers;
use CodeIgniter\Controller;

class AboutController extends Controller{
    
    function __construct(){
        
        helper(['url','text','form']);
        
    }//end function __construct()
    
    public function about(){
        
        $data1 = [
            'pageTitle'=>"About Name from Controller",
            'pageHeading'=>'About Page Heading'
        ];
        
        echo view("about_page.php",$data1);
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