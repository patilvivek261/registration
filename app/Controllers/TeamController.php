<?php 
/**
 * 
 */
namespace app\Controllers;
use CodeIgniter\Controller;

class TeamController extends Controller{
    
    function __construct(){
        
        helper(['url','text','form']);
        
    }//end function __construct()
    
    public function team(){
        
        $data1 = [
            'pageTitle' => 'Our Team Page',
            'pageHeading' => 'Our Team Page Heading',
        ];
        
        echo view("team_page.php",$data1);
        return TRUE;
        
    }//end function team()
    
    public function _remap($method,$param1=NULL,$param2=NULL){
        
        if(method_exists($this,$method))
        {
            return $this->$method($param1,$param2);
            
        }//end if method_exists()
        else 
        {
            return $this->team();
            
        }//end else method_exists()
        
    }//end function _remap()
    
}//end class TeamController

?>