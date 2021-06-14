<?php 
/**
 * 
 */
namespace App\Controllers;
use CodeIgniter\Controller;

class HomeController extends Controller{
 
    
    public function home(){
        
        
        function __construct(){
            
           helper(['url','text']); 
            
        }//end function constructor __contruct()
        
        $data1=[
            'pageTitle' => 'Home from Controller',
            'pageHeading'=>'Welcome On HomePage',
        ];
        
        
 //       echo view("view-t.php",$data1);
        echo view("home_page.php",$data1);
        return TRUE;
    }
    
    public function _remap($method,$param1=NULL,$param2=NULL){
        
        if(method_exists($this, $method))
        {
            return ($this->$method($param1,$param2));
        }//endif methodexists
        else
        {
            return $this->home();
        }//endelse methodexists
        
    }//end function remap()
}

?>