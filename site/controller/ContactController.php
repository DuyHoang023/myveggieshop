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
        $to = SHOP_OWNER;
        $subject = "Chicken";
        $content = "Cow";
        $emailService = new EmailService;
        $emailService->send($to, $subject, $content);
        echo 'Đã gởi mail thành công';
    }
}
