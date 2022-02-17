<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="/landing/css/login.min.css">
    <link rel="shortcut icon" href="/landing/img/Logo Dishub.png" type="image/x-icon">
</head>

<body>
    <div class="container">
        <div class="box">
            <div class="box-login">
                <div class="nav">
                    <ul class="menu">
                        <a href="/"> &#8592; kembali</a>
                    </ul>
                    <div class="logo">
                        <img src="/landing/img/Logo Dishub.png" class="logo-image" alt="">
                    </div>
                    <div class="login-title">
                        <h2>Login</h2>
                        <p>bagi anggota yang sudah punya akun silahkan login.</p>
                        <?php if (session()->getFlashdata("pesan")) : ?>
                            <p style="color:red"><?= session()->getFlashdata("pesan"); ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="form-login">
                        <form action="/pjlp/login" method="post">
                            <div class="form-group <?= ($validation->hasError('userid')) ? "has-error" : ""; ?>">
                                <label for="userid">Pjlp Id</label>
                                <input type="number" name="userid" id="userid" class="form-control" placeholder="Masukan No PJLP Anda" value="<?= old('userid'); ?>">
                            </div>
                            <div class="form-group <?= ($validation->hasError('password')) ? "has-error" : ""; ?>">
                                <label for="password">password</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Masukan Password Anda" value="<?= old('password')  ?>">
                            </div>
                            <div class="validation">
                                <p class="text-dangers"><?= $validation->getError('userid'); ?></p>
                                <p class="text-dangers"><?= $validation->getError('password'); ?></p>
                            </div>
                            <div class="footer-form">
                                <div class="form-control-group">
                                    <input type="checkbox" name="ingat" id="ingat" class="checkbox">
                                    <label for="ingat">ingat saya</label>
                                </div>
                                <div class="f-password">
                                    <a href="#">Lupa Password ?</a>
                                </div>
                            </div>
                            <div class="btn-action">
                                <button type="submit" class="btn login">Login</button>
                                <button type="reset" class="btn reset">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="box-banner">
                <img src="/landing/img/Logo Dishub.png" alt="">
            </div>
        </div>
    </div>
</body>

</html>