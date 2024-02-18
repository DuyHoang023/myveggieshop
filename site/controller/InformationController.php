<?php
class InformationController
{
    // Chính sách thanh toán
    function paymentPolicy()
    {
        $pattern = $_GET['pattern'] ?? null;
        require 'view/information/paymentPolicy.php';
    }

    // Chính sách đổi trả
    function returnPolicy()
    {
        $pattern = $_GET['pattern'] ?? null;
        require 'view/information/returnPolicy.php';
    }

    // Chính sách giao hàng
    function deliveryPolicy()
    {
        $pattern = $_GET['pattern'] ?? null;
        require 'view/information/deliveryPolicy.php';
    }
}
