<?php
session_start();
if (isset($_SESSION["email"])) {
    $akses = $_SESSION["akses"];
    header("Location: $akses.php");
    exit;
}

include 'config/funtions.php';
if (isset($_POST["login"])) {
    $user = $_POST["user"];
    $akses = $_POST["akses"];
    $password = md5($_POST["password"]);
    $result = query("SELECT * FROM pekerja WHERE user = '$user'");

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if ($row["user"] == $user) {
            if ($row["akses"] == $akses) {
                if ($row["password"] === $password) {
                    $_SESSION['user'] = $row['user'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['akses'] = $row['akses'];
                    header("Location:index.php");
                }
                echo "<script>
                alert('Password salah!');
                document.location.href= 'index.php';
                </script>";
            }
            echo "<script>
            alert('Anda bukan $akses!');
            document.location.href= 'index.php';
            </script>";
        }
    }else{
        echo "<script>
        alert('Username salah!');
        document.location.href= 'index.php';
        </script>";
    }
    $error = true;
}
if (isset($_POST["tambah"])) {
    if (create($_POST) > 0) {
        echo "<script>
        alert('Yup berhasil Menambah! ☺');
        document.location.href= 'index.php';
        </script>";
    }else {
        echo "<script>
        alert('Maaf Gagal Menambah!');
        </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="libraries/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="libraries/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Englebert|Combo|Special+Elite|Modern+Antiqua&display=swap&subset=latin-ext&effect=shadow-multiple">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source%20Code%20Pro">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@1,700&display=swap">
    <script type="text/javascript" src="js/jquery-3.5.1.js"></script>
    <title>Pekerja</title>

    <style>
        a:link {
            text-decoration: none;
            text-decoration-color: unset;
        }
        h3 {
            font: normal normal 100% Josefin Sans;
            color: #776f9f;
        }
        .valign {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
        }
        div.card-header ul li a:hover,
        div.card-header ul li a.hoverover {
            cursor: pointer;
            color: #348ceb;
        }
        .panel {
            border-radius: 15px;
        }
        body,
        html {
            background-image: url("https://images.pexels.com/photos/442574/pexels-photo-442574.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940");
            /* background-color: #b6cafa; */
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
            color: black;
        }
    </style>
</head>
 
<body>
    <div class="container valign" style="text-align: center; margin-top: 30px;">
        <div class="card text-center panel">
            <div class="card-header">
                <ul class="nav nav-pills card-header-tabs justify-content-center" style="margin: 20px;">
                    <li style="font-family: Josefin Sans; text-align: center;">
                        <div class="h3">Data Pekerja</div>
                    </li>
                </ul>
                <ul class="nav nav-pills card-header-tabs justify-content-end">
                    <li class="nav-item">
                        <a class="nav-link menu text-white btn-info" id="tambah">Tambah User</a>
                    </li>
                </ul>
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link menu" id="user">user</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu" id="admin">admin</a>
                    </li>
                </ul>
            </div>
            <!-- disini masuk file terpisah -->
            <div class="badan">
            </div>

            <div class="card-footer text-muted" style="font-family: 'Courier New', Courier, monospace; font-size: 10pt">
                <b><?php echo format_hari(date("Y-m-d")); ?></b>
            </div>
        </div>
    </div>




</body>
<script type="text/javascript">
    $(document).ready(function() {
        $('.menu').click(function() {
            var menu = $(this).attr('id');
            if (menu == "user") {
                $('.menu').removeClass('active');
                $('.badan').load('resource\\page\\form-login-user.php');
                $('#user').addClass('active');
            } else if (menu == "tambah") {
                $('.menu').removeClass('active');
                $('.badan').load('resource\\page\\form-reg.php');
                $('#tambah').addClass('active');
            } else if (menu == "admin") {
                $('.menu').removeClass('active');
                $('.badan').load('resource\\page\\form-login-admin.php');
                $('#admin').addClass('active');
            }
        });
        // halaman yang di load default pertama kali
        $('.badan').load('resource\\page\\form-login-user.php');
        $('#user').addClass('active');
    });
</script>
<script src="js/bootstrap.min.js"></script>
<script src="libraries/moment/moment.min.js"></script>
<script src="libraries/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="js/custom.js"></script>

</html>