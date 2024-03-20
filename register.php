<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#000">
    <link href="assets/bootstrap-v5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/login.css">

    <title>Register</title>
</head>

<body>
    <section class="bg-primary d-flex justify-content-center align-items-center" style="min-height: 100vh; background: linear-gradient(to bottom right, #ff9a9e, #fad0c4);">
        <div class="container py-5">
            <div class="row d-flex justify-content-center align-items-center h-100">

                <div class="col-12 col-md-8 col-lg-6 col-xl-5">

                    <div class="card shadow-lg" style="background-color: #ffd3b6; border-radius: 1rem;">
                        <div class="card-body px-sm-5 py-sm-4 p-3 text-center">
                            <h3 class="mt-3 mb-5">Registrasi</h3>
                            <?php
                            if (isset($_SESSION['registration_error'])) {
                                echo $_SESSION['registration_error'];
                                unset($_SESSION['registration_error']);
                            }

                            if (isset($_SESSION['registration_success'])) {
                                echo $_SESSION['registration_success'];
                                unset($_SESSION['registration_success']);
                            }
                            ?>

                            <form action="prosesregister.php" method="post">
                                <div class="form-outline">
                                    <input type="text" name="username" id="username" class="form-control" required />
                                    <label class="form-label" for="username">Username</label>
                                </div>
                                <div class="form-outline">
                                    <input type="password" name="password" id="password" class="form-control" required />
                                    <label class="form-label" for="password">Password</label>
                                </div>
                                <div class="form-outline">
                                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" required />
                                    <label class="form-label" for="confirm_password">Konfirmasi Password</label>
                                </div>

                                <button class="btn btn-success btn-md btn-block my-3" type="submit">Daftar</button>
                                <p class="mb-0">Sudah punya akun? <a href="index.php">Masuk</a></p>
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