<?php
class AuthController
{
    function login()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $customerRepository = new CustomerRepository;
        $customer = $customerRepository->findEmail($email);
        if (!$customer) {
            $_SESSION['error'] = "Lỗi: Email $email không tồn tại trong hệ thống";
            // về trang chủ
            header('location: /');
            exit;
        }
        echo 'Tiếp tục kiểm tra';
    }

    function logout()
    {
    }
}
