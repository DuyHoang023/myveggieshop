<?php
class AuthController
{
    function login()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $customerRepository = new CustomerRepository;
        $customer = $customerRepository->findEmail($email);
        var_dump($customer);
    }

    function logout()
    {
    }
}
