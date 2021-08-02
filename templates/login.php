<h2>Login</h2>
<form action="" method="post" class="needs-validation">

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">@</span>
        </div>
        <input id=form-login-username class="form-control" type="text" required="true" placeholder="Username"
               name="username"/>
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">*</span>
        </div>
        <input id=form-login-password class="form-control" type="password" required="true" placeholder="Password"
               name="password"/>
    </div>
    <div class="input-group mb-3">
        <input class="btn btn-block btn-outline-primary" type="submit" value="login" name="login"/>
    </div>
</form>

<a class="btn btn-block btn-outline-primary" href="?controller=register" role="button">Register</a>
</div>