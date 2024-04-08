<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('location:beranda.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#000">
    <link href="assets/bootstrap-v5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/login.css">

    <title>Login</title>
</head>

<body>
    <section class="d-flex justify-content-center align-items-center" style="min-height: 100vh; background: linear-gradient(to bottom left, #ff9a9e, #fad0c4);">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">

                <div class="col-12 col-md-8 col-lg-6 col-xl-5">

                    <div class="card shadow-lg" style="background-color: #ffd3b6; border-radius: 1rem;">
                        <div class="card-body px-sm-5 py-sm-4 p-3 text-center">
                            <div class="mb-3 d-flex align-items-center justify-content-center">
                                <img src="images/logo.svg" width="150px" alt="logo">
                            </div>
                            <h4 class="fw-bold">
                                APLIKASI
                                PENGELOLAAN
                                ARSIP
                                REKAMAN
                            </h4>
                            <hr class="mb-4">
                            <?php
                            if (isset($_SESSION['login_error'])) {
                                echo $_SESSION['login_error'];
                                unset($_SESSION['login_error']);
                            }

                            if (isset($_SESSION['validation_error'])) {
                                echo $_SESSION['validation_error'];
                                unset($_SESSION['validation_error']);
                            }
                            ?>
                            <form action="proseslogin.php" method="POST">
                                <div class="form-outline">
                                    <input type="text" name="username" id="username" class="form-control" required autofocus />
                                    <label class="form-label" for="username">Username</label>
                                </div>
                                <div class="form-outline">
                                    <input type="password" name="password" id="password" class="form-control" required />
                                    <label class="form-label" for="password">Password</label>
                                </div>

                                <button class="btn btn-success btn-lg btn-block my-4" type="submit">Masuk</button>
                                <p class="mb-2">Belum punya akun? <a href="register.php">Daftar</a></p>
                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <script>
        setTimeout(function() {
            document.querySelector('.alert').style.display = 'none';
        }, 4000);
    </script>
</body>

</html>