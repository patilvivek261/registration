<?php 
/**
 * 
 */
namespace App\Controllers;
use CodeIgniter\Controller;

class PortfolioController extends Controller{
    
    function __construct(){
        
        helper(['url','text']);
        
    }//end function __constructor()

    public function portfolio(){
        
        $data1 = [
            'pageTitle' => 'Portfolio Title Controller',
            'pageHeading' =>'Portfolio Page from Heading from Controller ',
        ];
        echo view("portfolio_page.php",$data1);
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