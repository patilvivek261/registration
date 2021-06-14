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
    
    <div class="form-group">
        <input type="submit" name="loginSubmit" style="width:10%;" value="Login" class="btn btn-primary" >
        <a href="#" target="_blank"> &nbsp;Forgot password?</a>&nbsp; / &nbsp; <a href="#" target="_blank">Sign Up</a>    
    </div>

</form>
        
    <div>
        <div id="fb-root"></div>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v11.0" nonce="9YS3qAUl"></script>
        <div class="fb-login-button" data-width="" data-size="medium" data-button-type="continue_with" data-layout="default" data-auto-logout-link="false" data-use-continue-as="false"></div>
    </div>
    

    
</div>

<?php 
$this->endSection();


?>