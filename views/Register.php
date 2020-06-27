<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4 pt-5">
            <h2>Registration</h2>
            <form method="post" action="" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="exampleInputEmail1">Username</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                           name="register-username" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail2">Email</label>
                    <input type="email" class="form-control" id="exampleInputEmail2" aria-describedby="emailHelp"
                           name="register-email" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="register-password" required>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlFile1" class="btn btn-success">Upload Photo</label>
                    <input onchange="previewProfilePhoto()" type="file" class="form-control-file upload-img" id="exampleFormControlFile1" name="register-photo"
                           required>
                    <img id="profile-img-preview" src="" alt="Your Image" class="img-thumbnail preview-img"/>
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
                <a href="login" class="float-right">Login</a>
            </form>
            <h3><?php if (isset($_SESSION['reg-error'])) {
                    echo $_SESSION['reg-error'];
                } ?></h3>
        </div>
    </div>
</div>