<?php
include '../controller/config.php';
session_start();

if (isset($_SESSION['id'])) {
    header("Location: index.php");
}

if (isset($_POST['submit'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $_SESSION['username'] = $user;

    $sql = mysqli_query($conn, "SELECT * FROM auth WHERE Username='$user' OR Email='$user'");
    $result = mysqli_fetch_assoc($sql);

    // Password Hash PHP
    // $cek = password_verify($pass, $result['Password']);

    $kode_petugas = $result['Kode_petugas'];
    date_default_timezone_set('Asia/Jakarta');
    $now = date("Y-m-d H:i:s");
    // echo $now;
    //MD5 Method
    if (md5($pass) == $result['Password']) {
        $insert = mysqli_query($conn, "UPDATE auth SET Status=1, Last_login='$now' WHERE Kode_petugas='$kode_petugas'");
        $_SESSION['id'] = $result['Kode_petugas'];
        $_SESSION['password'] = $result['Password'];
        $_SESSION['status'] = "login";

        header("location:../index.php");
    } else {
        header("location:login.php?pesan=gagal");
    }

    // echo md5($pass);
    // echo "<br>", $result['Password'];
}



?>
<!doctype html>
<html lang="en">

<head>
    <title>Login - GeoBase</title>
    <?php include 'Meta.php'; ?>
    <!-- <meta charset="utf-8"> -->
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <!-- Favicon icon -->
    <!-- <link rel="icon" type="image/ico" sizes="16x16" href="../public/favicon.ico"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- <script src="https://kit.fontawesome.com/a341d667ca.js" crossorigin="anonymous"></script> -->
</head>

<body>
    <div class="container">
        <div class="row justify-content-center mt-5 mb-5">
            <img src="../public/logo.png" style="width: 200px;" alt="">
        </div>
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="card-group">
                    <div class="card p-4">
                        <div class="card-body">
                            <?php
                            if (isset($_GET['pesan'])) {
                            ?>
                                <div class="alert alert-warning d-flex align-items-center" role="alert">
                                    <i class="fa-solid fa-circle-exclamation flex-shrink-0 me-2"></i>
                                    <div>
                                        Username atau Password yang anda masukkan salah!
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                            <h1 class="mb-5 text-center">Login</h1>
                            <form method="POST" action="">
                                <div class="form-floating mb-3">
                                    <?php
                                    if (isset($_GET['pesan'])) {
                                    ?>
                                        <input type="text" class="form-control" autofocus id="floatingInput" name="username" placeholder="name@example.com" autocomplete="off" value="<?= $_SESSION['username']; ?>">
                                    <?php } else { ?>
                                        <input type="text" class="form-control" autofocus id="floatingInput" name="username" placeholder="name@example.com" autocomplete="off">
                                    <?php } ?>
                                    <label for="floatingInput">Email / Username</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" autocomplete="off">
                                    <label for="floatingPassword">Password</label>
                                </div>

                                <div class="form-group ">
                                    <div class=" text-right">
                                        <button type="submit" class="btn btn-primary btn-lg" name="submit" style="padding-left: 2.5rem; padding-right: 2.5rem;">
                                            Sign In
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- <div class="card text-white bg-primary py-5 d-md-down">
                        <div class="card-body text-center">
                            <div>
                                <h2>Login Pegawai BPS</h2>
                                <p>Untuk pegawai BPS,<br> silakan Login SSO<br> menggunakan akun community</p>
                                <a class="btn btn-outline-light" href="https://webapps.bps.go.id/olah/sbh2022/login/sso">Login SSO</a>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-5 px-4 px-xl-5 bg-primary" style="position:relative; bottom: 0; top: 30; left: 0; right: 0;"> -->
    <!-- Copyright -->
    <!-- <div class="text-white mb-3 mb-md-0"> -->
    <!-- All Rights Reserved by GeoBase&COPY; 2022 -->
    <!-- </div> -->
    <!-- Copyright -->

    <!-- Right -->
    <!-- <div> -->
    <!-- <a href="mailto:polah3bps@gmail.com" class="text-white me-4"> -->
    <!-- <i class="fab fa-google"></i> -->
    <!-- </a> -->
    <!-- </div> -->
    <!-- Right -->
    <!-- </div> -->
    <footer class="footer mt-5 mb-4">
        <div class="container text-center d-flex flex-column flex-md-row text-md-start justify-content-between">
            <div class="mb-3 mb-md-0">All Rights Reserved by <a href="index.php">GeoBase</a>&COPY; 2022</div>
            <a href="mailto:polah3bps@gmail.com" class="text-primary me-4">
                <i class="fab fa-google"></i></a>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>