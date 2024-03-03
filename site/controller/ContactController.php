<?php

class ContactController
{
    // hiển thị trang liên hệ
    function form()
    {
        $pattern = $_GET['pattern'] ?? '';
        require 'view/contact/form.php';
    }

    // gởi mail đến chủ cửa hàng
    function sendEmail()
    {
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $message = $_POST['content'];
        $to = SHOP_OWNER;
        $subject = APP_NAME . ' - liên hệ';
        $content = "
        Xin chào chủ cửa hàng, <br>
        Dưới đây là thông tin khách hàng liên hệ, <br>
        Tên: $fullname, <br>
        Mobile: $mobile, <br>
        Email: $email, <br>
        Nội dung: $message<br>
        ------------------<br>
        Được gởi từ trang web: http://myveggieshop.com
        ";
        $emailService = new EmailService;
        $emailService->send($to, $subject, $content);
        echo 'Đã gởi mail thành công';
    }
}
