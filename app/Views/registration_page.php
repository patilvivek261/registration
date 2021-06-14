<?php 
/*
 * 
 */
$regPageSession = \Config\Services::session();
$this->extend('layouts/base_inner_page.php');

$this->section('pageTitleSection');
echo $pageTitle;
$this->endsection();

$this->section('pageHeadingSection');
echo $pageHeading;
$this->endsection();

$this->section('pageBodySection');
?>
<div class="justify-content-center align-items-center">
    
    <h1>Registration Form</h1>
    <?php 
    /*
     * To focus on fields ??
     * 
     * To list all errors use following 
     * $validation->listErrors();
     */ 
    ?>
    <?php
        if($regPageSession->getTempdata('success'))
        {
            //print success message
            echo "<div class='alert alert-success'>".$regPageSession->getTempdata('success')."</div>";
        }
        elseif($regPageSession->getTempdata('error'))
        {
            //print error message
            echo "<div class='alert alert-danger'>".$regPageSession->getTempdata('error')."</div>";
        }
        else
        {
            //do nothing
        }
    ?>
        
    <?php if(isset($validation)){ echo "<div class='text-danger'>Please Enter Correct Information "."<br/><br/></div>"; }?>
    <form enctype="multipart/form-data" accept-charset="utf-8" action="<?= base_url()?>/RegistrationController/register" name="registrationForm" id="registrationForm" method="post" class="form-group" />
    <div class="form-group">
        <lable>Title</lable>
        <?php if(isset($validation)){echo displayErr($validation,'titleSal');}?>
        <select name="titleSal" id="titleSal"  class="form-control" style="width:30%;" required="required">
            <option value="">Select Title</option>
            <option value="Mr." <?= set_select('titleSal','Mr.'); ?> >Mr.</option>
            <option value="Ms." <?= set_select('titleSal','Ms.'); ?>>Ms.</option>
        </select>
    </div>
    
    <div class="form-group">
        <lable class="error-message-gen-disp">First Name</lable>
        <input type="text" name="firstName" id="firstName" value="<?= set_value('firstName'); ?>" class="form-control" style="width:30%;" required="required" />
        <?php if(isset($validation)){echo displayErr($validation,'firstName');}?>
    </div>
    
    <div class="form-group">
       <lable>Last Name</lable>
       <input type="text" name="lastName" id="lastName" value="<?= set_value('lastName');?>" class="form-control" style="width:30%;" required="required" />
       <?php if(isset($validation)){echo displayErr($validation,'lastName');}?>
    </div>
    
    <div class="form-group">
        <lable>Mobile</lable>         
        <input type="text" name="mobileNo" id="mobileNo" value="<?= set_value('mobileNo');?>" class="form-control" style="width:30%;" required="required" />
        <?php if(isset($validation)){echo displayErr($validation,'mobileNo');}?>
    </div>

    <div class="form-group">
        <lable>Email</lable>
        <input type="text" name="emailId" id="emailId" value="<?= set_value('emailId');?>" class="form-control" style="width:30%;" required="required" />
        <?php if(isset($validation)){echo displayErr($validation,'emailId');}?>
    </div>
    
    <div class="form-group">
        <lable>Password</lable>
        <input type="password" name="passw" id="passw" value="<?= set_value('passw');?>"  class="form-control" style="width: 30%;" required="required" />       
        <?php if(isset($validation)){echo displayErr($validation,'passw');}?>
    </div>
    
    <div class="form-group">
        <lable>Confirm Password</lable>
        <input type="password" name="cpassw" id="cpassw" value="<?= set_value("cpassw");?>"  class="form-control" style="width:30%;" required="required" />
        <?php if(isset($validation)){echo displayErr($validation,'cpassw');}?>
    </div>
    
    <input type="submit" name="registrationSubmit" style="width:10%;" value="Register" class="btn btn-primary" />
        
    </form>
    
</div>
<?php 
$this->endsection();
?>