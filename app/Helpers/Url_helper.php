<?php 
/**
 * Url helper
 */
function getUrl($seedUrl,$stripString="index.php/"){
        
    return str_replace($stripString,"",site_url($seedUrl));
}
?>