<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Athentification</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
<div class="row mt-4">
    <div class="col-md-6">
        <form class="offset-md-1 well" action="/njTestChat/login/auth" method="POST" >
            <h1 class="mb-3">sign in</h1>
            <?php
            if(isset($errorLogin)){
                ?>
                <div class="alert alert-danger">
                    <?= $errorLogin ?>
                </div>
            <?php } ?>
            <div class="form-group">
                <label for="input" class="sr-only">Username</label>
                <input type="input" name="username" id="username" class="form-control" placeholder="Username" required autofocus>
            </div>
            <div class="form-group">
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        </form>
    </div>


    <div class="col-md-6">
        <form  action="/njTestChat/login/register" method="POST" >
            <h1 class="mb-3">Register</h1>
            <?php
            if(isset($errorRegister)){
                ?>
                <div class="alert alert-danger">
                    <?= $errorRegister ?>
                </div>
            <?php } ?>
            <div class="form-group">
                <label for="input" class="sr-only">Username</label>
                <input type="input" name="username" id="username" class="form-control" placeholder="Username"  autofocus>
            </div>
            <div class="form-group">
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" >
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">register</button>
        </form>
    </div>

</div>

<script
    src="https://code.jquery.com/jquery-3.4.1.js"
    integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
    crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>
</body>
</html>