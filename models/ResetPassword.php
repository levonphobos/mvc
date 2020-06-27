<?php


class ResetPassword extends Controller
{
    static function resetPass()
    {
        if (isset($_POST['reset-password'])) {
            $newPass = md5($_POST['reset-password']);
            $values = array('password' => $newPass);
            $keys = array('email' => Session::get('reset-email'));
//            print_r($values);
//            echo '<br>';
//            print_r($keys);
            $user = new User();
            if ($user->edit($values, $keys)) {
                Session::set('send-mail-response', 'Password Updated');
            } else {
                Session::set('send-mail-response', 'Something Went Wrong. Please Try Again.');
            }
            Session::set('code', '');
            Session::set('reset-email', '');
            header('location:login');
        }
    }

}