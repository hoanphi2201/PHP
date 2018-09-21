<?php
    $message = "";
    switch ($this->arrParam['type']) {
        case 'register success':
            $message = "Tài khoản của bạn đã được tạo thành công vui lòng chờ kích hoạt từ quản trị viên";
            break;
        
        default:
            # code...
            break;
    }
    
    ?>

    <div class="notice"><?php echo $message ?></div>