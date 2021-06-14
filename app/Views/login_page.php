<?php 
/**
 * 
 */

$this->extend('layouts/base_inner_page.php');

$this->section('pageTitleSection');
echo $pageTitle;
$this->endsection();

$this->section('pageHeadingSection');
echo $pageHeading;
$this->endsection();

$this->section('pageBodySection');?>
<div class="justify-content-center align-items-center">
    
    <h1>Login Form</h1>
    <form enctype="multipart/form-data" action="/LoginController" name="loginForm" id="loginForm" />
    
    <div class="form-group">
        <lable>Email</lable>
        <input type="text" name="email" id="email" class="form-control" style="width:30%;" required="required">
    </div>
    
    <div class="form-group">
        <lable>Password</lable>
        <input type="password" name="pass" id="pass" class="form-control" style="width: 30%;" required="required">
        
    </div>
    
    <input type="submit" name="loginSubmit" style="width:10%;" value="Login" class="btn btn-primary" >
        
    </form>
    
</div>

<?php 
$this->endSection();


?>