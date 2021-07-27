<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sing in</title>
    <link rel="stylesheet" href="./login/style.css">
    <link rel="stylesheet" href="./login/bootstrap.min.css">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
</head>
<style>
    body {
        background-image: url('./login/background.png');
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: 100% 100%;
    }
</style>

<body class="fix-menu">

    <section class="mt-5">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="login-card card-block auth-body mr-auto ml-auto">
                        <form action="login_db.php" method="post" class="md-float-material">
                            <div class="text-center">
                                <img src="login/logo.png" style="width: 415px;" alt="logo.png">
                            </div>
                            <div class="auth-box">
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h3 class="text-left txt-primary d-flex justify-content-center">เข้าสู่ระบบ</h3>
                                    </div>
                                </div>
                                <div class="input-group ">
                                    <input type="text" name="username" class="form-control" placeholder="Username" required>
                                    <span class="md-line"></span>
                                </div>
                                <div class="input-group">
                                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                                    <span class="md-line"></span>
                                </div>
                                <div class="row m-t-30">
                                    <div class="col-md-12">
                                        <button type="submit" name="btn_login" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20 btn btn-warning">Sign
                                            in</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>