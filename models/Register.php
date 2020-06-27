<?php

class Register extends Controller
{
    static function registration(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['register-username']) && isset($_FILES['register-photo']['name']) && isset($_POST['register-password'])) {
                $target_dir = "uploads/";
                if (!is_dir($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }

                $target_file = $target_dir . basename($_FILES['register-photo']['name']);
                move_uploaded_file($_FILES['register-photo']["tmp_name"], $target_file);
                $data = array("name" => $_POST['register-username'], "photo" => $_FILES['register-photo']['name'], 'email' => $_POST['register-email'], "password" => md5($_POST['register-password']));
                $user = new User();
                if ($user->save($data)) {
                    Session::set('reg-error', '');
                    $loginData = array('name' => $data['name'], 'password' => $data['password']);
                    $user->login($loginData);
                    if (Session::get('select_result')->num_rows > 0) {
                        while ($row = Session::get('select_result')->fetch_assoc()) {
                            Session::set('name', $row['name']);
                            Session::set('photo', $row['photo']);
                            Session::set('user_id', $row['id']);
                        }
                        Session::set('send-mail-response', '');
                        header('location:home');
                    } else {
                        Session::set('login-error', 'Login Failed');
                        header("location:login");
                    }
                } else{
                    Session::set('reg-error', 'Registration Failed');
                    header('location:registration');
                }
            }
        }
    }

}