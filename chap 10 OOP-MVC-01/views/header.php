<?php 
    $menu = '<a class="index" href="index.php?controller=index&action=index">Home</a>';
    Session::Init();

    if(Session::get('loggedIn') == 1){
        $menu   .='<a class="group" href="index.php?controller=group&action=index">Group</a>';        
        $menu   .='<a class="user" href="index.php?controller=user&action=logout">Logout</a>';
    }else{
        $menu .= '<a class="user" href="index.php?controller=user&action=login">Login</a>';
    }
    $fileJs = "";
    $fileCss = "";
    if(!empty($this->js)){
        foreach ($this->js as $key => $value) {
            $fileJs .= '<script src="'.VIEW_URL.$value.'"></script>';
        }
    }
    if(!empty($this->css)){
        foreach ($this->css as $key => $value) {
            $fileCss .= '<link rel="stylesheet" href="'.VIEW_URL.$value.'"></link>';
        }
    }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo PUBLIC_URL; ?>css/style.css">
    <script src="<?php echo PUBLIC_URL; ?>js/jquery.js"></script>
    <script src="<?php echo PUBLIC_URL; ?>js/customs.js"></script>
    <?php echo $fileJs?>
    <?php echo $fileCss?>

    <title><?php echo ((isset($this->title)) ? $this->title : "MVC"); ?></title>
    <script>
        
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <h3>Header</h3>
            <?php echo $menu ?>

        </div>