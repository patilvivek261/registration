<?php 
/**
 * 
 */
$dashboardSession = \Config\Services::session();


$this->extend('layouts/base_inner_page.php');


$this->section('pageTitleSection');
echo $pageTitle;
$this->endsection();

$this->section('pageHeadingSection');
echo $pageHeading;
$this->endsection();

$this->section('pageBodySection');
    if($dashboardSession->get('loginUsrDataUid')){
        
?>      
        <br/>
        <a href="<?= base_url()?>/DashboardController/logout"> Logout </a>
<?php
    }//end if check $dashboardSession->get('loginUsrDataUid')
    else{
        
    }
$this->endsection();
?>