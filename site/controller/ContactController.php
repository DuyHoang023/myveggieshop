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
    }
}
