<?php

class Login extends Controller
{
    static function userLogin()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['login-name']) && isset($_POST['login-password'])) {
                $loginData = array("name" => $_POST['login-name'], "password" => md5($_POST['login-password']));
                $user = new User();
                $user->login($loginData);
                if (Session::get('select_result')->num_rows > 0) {
                    Session::set('login-error', '');
                    while ($row = Session::get('select_result')->fetch_assoc()) {
                        Session::set('name', $row['name']);
                        Session::set('photo', $row['photo']);
                        Session::set('user_id', $row['id']);
                    }
                    Session::set('send-mail-response', '');
                    $coverPhoto = new CoverPhoto();
                    $data = array('user_id' => Session::get('user_id'));
                    $coverPhoto->getCoverPhoto($data);
                    if (Session::get('select_result')->num_rows > 0) {
                        while ($row = Session::get('select_result')->fetch_assoc()) {
                            Session::set('cover-photo', $row['name']);
                        }
                    } else {
                        Session::set('cover-photo', '');
                    }
                    $userPost = new UserPost();
                    $userPost->getPosts($data);
                    if (Session::get('select_result')->num_rows > 0) {
                        Session::set('posts', Session::get('select_result')->fetch_all());
                    } else {
                        Session::set('posts', []);
                    }
                    header('location:home');
                } else {
                    Session::set('login-error', 'Login Failed');
                    header("location:login");
                }
            }
        }
    }

    static function sendResetLinkToMail()
    {
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(isset($_POST['send-email'])){
                $to = $_POST['send-email'];
                Session::set('reset-email', $_POST['send-email']);
                $subject = "Reset Password";
                $code= uniqid();
                Session::set('code', $code);
                $url = "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/reset_password?code=$code";
                $txt = '
<h3>
You are requested a password reset
</h3>
<p>Click <a href="'.$url.'">this link</a> to do so</p>
';
                $headers = "From: lauramamunc11@gmail.com";
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
//                $headers .= 'From: <webmaster@example.com>' . "\r\n";
//                $headers .= 'Cc: myboss@example.com' . "\r\n";
                if(mail($to,$subject,$txt, $headers)){
                    Session::set('send-mail-response', 'We are send update URL on your mail.');
                } else{
                    Session::set('send-mail-response', 'Wrong email. Please try again.');
                }
                header('location:login');
            }
        }
    }

}
