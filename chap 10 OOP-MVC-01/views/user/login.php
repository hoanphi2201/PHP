<?php
    echo $errors = !empty($this->errors) ? $this->errors : "" ;
?>
<div class="content">
    <h3>Login Form</h3>
    <form action="index.php?controller=user&action=login" method="POST" name="form-login" id="form-login">
        <div class="row">
            <p>Username</p>
            <input type="text" name="username">
        </div>
        <div class="row">
            <p>Password</p>
            <input type="password" name="password">
        </div>
        <div class="row">
            <input type="submit" name="submit" value="Đăng nhập">
        </div>
    </form>
</div>

