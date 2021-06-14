<?php
$this->extend('layouts/base_inner_page.php');

$this->section('pageTitleSection');
echo $pageTitle;
$this->endsection();

$this->section('pageHeadingSection');
echo $pageHeading;
$this->endsection();

$this->section('pageBodySection');

//check if success/error for activation of user account 
if(isset($success))
{
    //accont activation success
    echo "<div class='alert alert-success'>$success</div>";    
}
elseif($error)
{
    // Account activation error
    echo "<div class='alert alert-danger'>$error</div>";    
}
elseif($alrdyactv)
{
    // Account is already active
    echo "<div class='alert alert-danger'>$alrdyactv</div>";    
}
else
{
    // No Activation Status 
    echo "<div class='alert alert-danger'>Account Activation Process Failed, Please Try Again..!!</div>";    
    
}

$this->endsection();


?>