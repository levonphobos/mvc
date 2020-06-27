<?php
//if (!$_SESSION['user_id']) {
//    header('location:login');
//}
//
?>
<div class="photo_block">
    <div>
        <img src="uploads/<?php echo Session::get('photo') ?>" class="img-thumbnail" alt="Profile Picture">
        <h4><?php echo Session::get('name') ?></h4>
    </div>
    <?php if (!Session::get('cover-photo')) {
        echo '
        <form method="post" action="" id="form" enctype="multipart/form-data" class="cover_photo_upload_form">
        <label for="cover" class="cover_inp" title="Upload Cover Photo">
        <img src="images/add.png" alt="Add">
        </label>
        <input id="cover" type="file" name="add-cover" required onchange="previewImage(this.id)">
    </form>
    <button form="form" type="submit" onclick="hide()" class="btn btn-success save_btn" id="save" style="display: none;">
    Save
    </button>
        ';
    } ?>

    <img src="" id="preview" class="img-thumbnail preview_img" alt="preview">

    <img src="" id="previewEdit" class="img-thumbnail preview_img" alt="preview">


    <?php if (Session::get('cover-photo')) {
        echo '<img id="user_cover_photo" src="uploads/' . Session::get('cover-photo') . '" class="img-thumbnail" style="width:100%;" alt="Profile Picture">';
    } ?>

    <?php if (Session::get('cover-photo')) {

        echo '<div id="edit_del" class="edit-del">
        <form action="" method="post" enctype="multipart/form-data" id="edit_form" style="display: inline;">
            <label for="edit" style="cursor: pointer;"><i class="far fa-edit"></i></label>
            <input type="file" id="edit" name="edit-cover" style="display: none;" onchange="previewImageEdit(this.id)">
        </form>
            <button type="button" class="delete-btn" data-toggle="modal" data-target="#exampleModal">
                <i class="fas fa-trash-alt"></i>
            </button>
    </div>';
    }
    ?>

    <button id="edit_save" form="edit_form" type="submit" class="btn btn-success save_btn" style="display: none;">
        Save
    </button>


</div>

<button type="button" class="btn btn-primary logout_btn">
    <a href="?logout=logout">Logout</a>
</button>

<hr>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <form method="post" action="" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Write Your Post</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                              name="user-post"></textarea>
                    <br>
                    <button type="submit" class="btn btn-primary float-right">Post</button>
                </div>
            </form>
        </div>
        <div class="col-md-8 pt-5">
            <?php if (Session::get('posts')) {
                foreach (Session::get('posts') as $value) {
                    echo '
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <span>' . $value[1] . '</span>
                                <strong class="float-right">' . $value[2] . '</strong>
                                <form action="" enctype="multipart/form-data" method="post" class="d-inline">
                                <button type="submit"
                                    name="post-delete-'.$value[0].'" class="close" value="'.$value[0].'">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </form>
                    </div>
                    ';
                }
            }
            ?>
        </div>
    </div>
</div>
<br><br><br>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Cover Photo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete your cover photo?
            </div>
            <div class="modal-footer">
                <form action="" method="post" enctype="multipart/form-data" style="display: inline;">
                    <button type="submit" name="delete-cover" class="btn btn-primary">Delete</button>
                </form>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>