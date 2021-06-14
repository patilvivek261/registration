<!DOCTYPE HTML>
<html>
<head>
	<title></title>
<style>
.errDisplay{
    color: red;
}
</style>		
</head>
<body>
	<div id="pageHeading" style="margin:1%">
		<h1>Please fill following form</h1>
	</div>
	<div id="divForm1" style="margin:2%;">
	
		<?php 
		/*            
		if(isset($validation))
		{
		?> 
		  <?= $validation->listErrors(); ?>
		    
		<?php 
		}
		*/
		?>
    	
    	<form name="form1" id="form1" action="https://localhost/registration/Form1/form1Check" method="post" accept-charset="utf-8" enctype="multipart/form-data" >
    		
    		<div>
    			<?php if(isset($validation)) { echo displayErr($validation,'firstName')."<br/>"; } ?>
    			<!--  <lable for="firstName">Enter First Name : </lable> -->Enter First Name :
    			<input type="text" name="firstName" value="<?= set_value('firstName')?>" id="firstName" maxlength="100" size="50"  />
    		</div>
    		
    		<br/>
    		
    		<div>
    			<?php if(isset($validation)) { echo displayErr($validation,'lastName')."<br/>"; } ?>
    			<lable for="LastName">Enter Last Name : </lable>
    			<input type="text" name="lastName" value="<?= set_value('lastName')?>" id="lastName" maxlength="100" size="50"  />
    		</div>
    		
    		<br/>
    		
    		<div>
    			<?php if(isset($validation)) { echo displayErr($validation,'emailId')."<br/>"; } ?>
    			<lable for="emailId">Enter Email Id : </lable>
    			<input type="text" name="emailId" value="<?= set_value('emailId')?>" id="emailId" maxlength="100" size="50"  />
    		</div>
    		
    		<br/>
    		
    		<div>
    			<?php if(isset($validation)) { echo displayErr($validation,'mobileNo')."<br/>"; } ?>
    			<lable for="mobileNo">Enter Mobile Number : </lable>
    			<input type="text" name="mobileNo" value="<?= set_value('mobileNo')?>" id="mobileNo" maxlength="100" size="50"  />
    		</div>
    		
    		<br/>
    		
    		<div>
        		<lable for="country">Select Country : </lable>
    			<select name="country" id="country">		
                    <option value="">Select Country</option>
                    <option value="India"  <?= set_select('country','India'); ?> >India</option>
                    <option value="Israel"  <?= set_select('country','Israel'); ?> >Israel</option>
                    <option value="USA"  <?= set_select('country','USA'); ?> >USA</option>
                    <option value="Japan"  <?= set_select('country','Japan'); ?> >Japan</option>
                    <option value="Taiwan"  <?= set_select('country','Taiwan'); ?> >Taiwan</option>
                </select>
    		</div>
    		
    		<br/>
    		
    		<div>
        		<lable for="firstName">Select Gender : </lable> <br/>
    			<input type="radio" name="gender"  id="male" value="Male" <?= set_radio('gender','Male'); ?> />
                <label for="male">Male</label><br>
                <input type="radio" name="gender" id="female" value="Female" <?= set_radio('gender','Female'); ?> />
                <label for="female">Female</label><br>
                <input type="radio" name="gender" id="other" value="Other" <?= set_radio('gender','Other'); ?>  />
                <label for="other">Other</label>
            </div>
    		
    		<br/>
    		
    		<input type="submit" name="form1Submit" value="Submited Form1" />
    	</form>

	</div>

</body>

</html>