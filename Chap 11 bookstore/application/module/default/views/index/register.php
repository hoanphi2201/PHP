<?php
	$dataForm		= isset($this->arrParam['form']) ? $this->arrParam['form'] : null;
	
	// Input
	$inputSubmit	= Helper::cmsInput('submit', 'form[submit]', 'submit', 'register', 'register');
	$inputToken		= Helper::cmsInput('hidden', 'form[token]', 'token', time()); 
	
	// Row
	$rowUserName	= Helper::cmsRow('Username', Helper::cmsInput('text', 'form[username]', 'username', isset($dataForm['username']) ? $dataForm['username']: null, 'contact_input'));
	$rowFullName	= Helper::cmsRow('Full Name', Helper::cmsInput('text', 'form[fullname]', 'fullname',isset($dataForm['fullname']) ? $dataForm['fullname']: null , 'contact_input'));
	$rowPassword	= Helper::cmsRow('Password', Helper::cmsInput('text', 'form[password]', 'password', isset($dataForm['password']) ? $dataForm['password']: null , 'contact_input'));
	$rowEmail		= Helper::cmsRow('Email', Helper::cmsInput('text', 'form[email]', 'email', $dataForm['email'], 'contact_input'));
	$rowSubmit		= Helper::cmsRow('Submit', $inputToken . $inputSubmit, true);
	//Link để submit
	$linkAction		= URL::createLink('default', 'user', 'register');
?>
<div class="title">
	<span class="title_icon"><img src="<?php echo $imageURL;?>/bullet1.gif"/></span>Đăng ký thành viên
</div>

<div class="feat_prod_box_details">
	<div class="contact_form">
		<div class="form_subtitle">create new account</div>
		<?php echo isset($this->errors) ? $this->errors :"";?>
		<form name="adminform" action="<?php echo $linkAction?>" method="POST">
			<?php echo $rowUserName . $rowFullName . $rowPassword . $rowEmail . $rowSubmit;?>
		</form>
	</div>
</div>
<div class="clear"></div>