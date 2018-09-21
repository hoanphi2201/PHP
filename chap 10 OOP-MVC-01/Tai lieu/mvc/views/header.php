<?php 
	$cssURL	= PUBLIC_URL . 'css' . DS;
	$jsURL	= PUBLIC_URL . 'js' . DS;
	Session::init();
	
	$menu = '<a class="index" href="index.php?controller=index&action=index">Home</a>';
	if(Session::get('loggedIn') == true){
		$menu .= '<a class="group" href="index.php?controller=group&action=index">Group</a>';
		$menu .= '<a class="user" href="index.php?controller=user&action=logout">Logout</a>';
	}else{
		$menu .= '<a class="user" href="index.php?controller=user&action=login">Login</a>';
	}
	
	// JS
	if(!empty($this->js)){
		foreach($this->js as $js) {
			$fileJs .= '<script type="text/javascript" src="'.VIEW_URL.$js.'"></script>';
		}
	}
	
	// CSS
	if(!empty($this->css)){
		foreach($this->css as $css) {
			$fileCss .= '<link rel="stylesheet" type="text/css" href="'.VIEW_URL.$css.'">';
		}
	}
	
	// TITLE
	$title = isset($this->title) ? $this->title : 'MVC';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title><?php echo $title;?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo $cssURL?>style.css">
	<script type="text/javascript" src="<?php echo $jsURL?>jquery.js"></script>
	<script type="text/javascript" src="<?php echo $jsURL?>custom.js"></script>
	<?php echo $fileJs . $fileCss;?>
</head>
<body>
	<div class="wrapper">
		<div class="header">
			<h3>Header</h3>
			<?php echo $menu;?>
		</div>