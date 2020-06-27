<?php


class Home extends Controller
{
    static function addCover()
    {
        if (isset($_FILES['add-cover']['name'])) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES['add-cover']['name']);
            move_uploaded_file($_FILES['add-cover']["tmp_name"], $target_file);
            $data = array("name" => $_FILES['add-cover']['name'], 'user_id' => Session::get('user_id'));
            $coverPhoto = new CoverPhoto();
            if ($coverPhoto->save($data)) {
                Session::set('cover-photo', $data['name']);
            }
            header("location:home");
        }
    }

    static function editCover(){
        if(isset($_FILES['edit-cover']['name'])){
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES['edit-cover']['name']);
            move_uploaded_file($_FILES['edit-cover']["tmp_name"], $target_file);
            $values = array("name" => $_FILES['edit-cover']['name']);
            $keys = array('user_id' => Session::get('user_id'));
            $coverPhoto = new CoverPhoto();
            if ($coverPhoto->edit($values, $keys)) {
                Session::set('cover-photo', $_FILES['edit-cover']['name']);
            }
            header("location:home");
        }
    }

    static function deleteCover(){
        if(isset($_POST['delete-cover'])){
            $coverPhoto = new CoverPhoto();
            $data = array('user_id' => Session::get('user_id'));
            if($coverPhoto->remove($data)){
                Session::set('cover-photo', '');
            }
            header("location:home");
        }
    }

    static function addPost(){
        if(isset($_POST['user-post'])){
            $userPost = new UserPost();
            $data = array('content' => $_POST['user-post'], 'user_id' => Session::get('user_id'));
            if($userPost->save($data)){
                $data = array('user_id' => Session::get('user_id'));
                $userPost->getPosts($data);
                if (Session::get('select_result')->num_rows > 0) {
                    Session::set('posts', Session::get('select_result')->fetch_all());
                } else {
                    Session::set('posts', []);
                }
            }
            header("location:home");
        }
    }

    static function deletePost(){
        if(isset($_POST)){
            foreach($_POST as $key => $value) {
                if (preg_match('/post-delete/i', $key)) {
                    $data = array('id' => $value);
                    $userPost = new UserPost();
                    if($userPost->remove($data)){
                        $data = array('user_id' => Session::get('user_id'));
                        $userPost->getPosts($data);
                        if (Session::get('select_result')->num_rows > 0) {
                            Session::set('posts', Session::get('select_result')->fetch_all());

                        } else {
                            Session::set('posts', []);
                        }
                    }
                    header("location:home");
                }
            }
        }
    }

    static function logout()
    {
        if (isset($_GET['logout']) && $_GET['logout'] === 'logout') {
            Session::destroy();
            header('location:login');
        }
    }

}