<?php 
function displayErr($validation, $errField){
    
    if(isset($validation))
    {
        if($validation->hasError($errField))
        {
            return "<div class='text-danger'>".$validation->getError($errField)."</div>";
            
        }//endif has error for that field
        else
        {            
            return false;
        }//end else has error for that field
        
    }//endif check validation array is set or not
    else 
    {
        return false;
    }//end else check validation array is set or not
  
    /*
    if(isset($validation))
    {
        if($validation->hasError($errField))
        {
                    
            return ($validation->getError($errField));
        }//endif $validation has error for that field
        else 
        {
            return "";
            
        }//endelse $validation has error for that field
        
    }//endif isset($validation)
    else 
    {
        return "";
        
    }//end else isset($validation)

}//end function displayErr()

     * 
     * 
     */
}
?>