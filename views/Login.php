<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4 pt-5">
            <h2>Login</h2>
            <form method="post" action="">
                <div class="form-group">
                    <label for="exampleInputEmail1">Username</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                           name="login-name" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="login-password"
                           required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <p>Don't have an account? <a href="register">Create Account</a></p>
            <button type="button" class="btn btn-link pl-0" data-toggle="modal" data-target="#exampleModal">
                Forget Password
            </button>
            <h5 class="text-danger"><?php
                if (Session::get('login-error')) {
                    echo Session::get('login-error');
                }
                ?></h5>
            <h5 class="text-success"><?php
                if(Session::get('send-mail-response')){
                    echo Session::get('send-mail-response');
                }
            ?>
            </h5>
        </div>
    </div>
</div>

<!--Login-->

<!-- Modal-->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" autocomplete="on" enctype="multipart/form-data" method="post" id="send-mail-form">
                    <label for="exampleInputEmail2">Email address</label>
                    <input type="email" class="form-control" name="send-email" id="exampleInputEmail2" aria-describedby="emailHelp">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" form="send-mail-form" class="btn btn-primary">Send Mail</button>
            </div>
        </div>
    </div>
</div>