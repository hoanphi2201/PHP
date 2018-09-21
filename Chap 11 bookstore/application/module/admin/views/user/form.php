<?php 
    include_once  MODULE_PATH . 'admin/views/toolbar.php' ;
    include_once 'submenu/index.php';
    
	//Input
	//arrParam chứa các thông tin của group
	$dataForm 			= isset($this->arrParam['form']) ? $this->arrParam['form'] : null ;
	$inputUserName		= Helper::cmsInput('text', 'form[username]', 'username', isset($dataForm['username']) ? $dataForm['username'] : null , 'inputbox required', 40);
	$inputEmail			= Helper::cmsInput('text', 'form[email]', 'email', isset($dataForm['email']) ? $dataForm['email'] : null , 'inputbox required', 40);
	$inputFullname		= Helper::cmsInput('text', 'form[fullname]', 'email', isset($dataForm['fullname']) ? $dataForm['fullname'] : null , 'inputbox', 40);
	$inputPassword		= Helper::cmsInput('text', 'form[password]', 'email', isset($dataForm['password']) ? $dataForm['password'] : null , 'inputbox required', 40);
	$inputOrdering		= Helper::cmsInput('text', 'form[ordering]', 'ordering', isset( $dataForm['ordering']) ?  $dataForm['ordering'] : null, 'inputbox', 40);
	$inputToken			= Helper::cmsInput('hidden', 'form[token]', 'token', time());
	$selectStatus		= Helper::cmsSelectbox('form[status]', null, array('default' => '- Select status -', 1 => 'Publish', 0 => 'Unpublish'),isset( $dataForm['status']) ?  $dataForm['status']: null, 'width: 150px');
	//GROUP
	$arrGroup		= $this->slbGroup;
	$selectboxGroup	= Helper::cmsSelectbox('form[group_id]', 'inputbox', $arrGroup, isset($dataForm['group_id']) ?$dataForm['group_id']:"");
	$inputID		= '';
	$rowID			= '';
	if(isset($this->arrParam['id']) || isset($dataForm['id'])){
		//readonly chỉ cho xem không cho sửa
		$inputID	= Helper::cmsInput('text', 'form[id]', 'id', $dataForm['id'], 'inputbox readonly');
		$rowID		= Helper::cmsRowForm('ID', $inputID);
		
	}
	// Row
	$rowUserName		= Helper::cmsRowForm('UserName', $inputUserName, true);
	$rowEmail			= Helper::cmsRowForm('Email', $inputEmail, true);
	$rowFullname		= Helper::cmsRowForm('Fullname', $inputFullname);
	$rowPassword		= Helper::cmsRowForm('Password', $inputPassword, true);
	$rowOrdering		= Helper::cmsRowForm('Ordering', $inputOrdering);
	$rowStatus			= Helper::cmsRowForm('Status', $selectStatus);
	$rowGroup		= Helper::cmsRowForm('Group', $selectboxGroup);
	
	// MESSAGE
	$message	= Session::get('message');
	Session ::delete('message');
	$strMessage = Helper::cmsMessage($message);
?>
<div id="system-message-container"><?php echo isset($this->errors) ? $this->errors : "" . $strMessage;?></div>
<div id="element-box">
	<div class="m">
		<form action="#" method="post" name="adminForm" id="adminForm" class="form-validate">
			<!-- FORM LEFT -->
			<div class="width-100 fltlft">
				<fieldset class="adminform">
					<legend>Details</legend>
					<ul class="adminformlist">
						<?php echo $rowUserName . $rowEmail . $rowFullname . $rowPassword . $rowStatus . $rowGroup . $rowOrdering . $rowID;?>
					</ul>
					<div class="clr"></div>
					<div>
						<?php echo $inputToken;?>
					</div>
				</fieldset>
			</div>
			<div class="clr"></div>
			<div>
			</div>
		</form>
		<div class="clr"></div>
	</div>
</div>
        
     