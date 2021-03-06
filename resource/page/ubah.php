<?php
session_start();
$sesi = $_SESSION["user"];
if (!isset($sesi) && $sesi != "admin") {
        header("Location:../../index.php");
        exit;
}
include '../../config/funtions.php';
$id = $_GET["id"];
if ($id == 1) {
    header("Location:../../index.php");
}
$data = query_getData("SELECT * FROM pekerja WHERE id = $id")[0];
$namaLengkap = $data["namaLengkap"];
$user = $data["user"];
$email = $data["email"];
$jk = $data["jk"];
$jabatan = $data["jabatan"];
$fotoLama = $data["foto"];
$password = $data["password"];
$akses = $data["akses"];

//$password = md5($password);
if (isset($_POST["ubah"])) {
    if (update($_POST) > 0) {
        echo "<script>
        alert('Yup berhasil diubah! ☺');
        document.location.href='../../index.php';
        </script>";
    }else {
        echo "<script>
        alert('Maaf Gagal Diubah!');
        </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../libraries/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../../libraries/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Englebert|Combo|Special+Elite|Modern+Antiqua&display=swap&subset=latin-ext&effect=shadow-multiple">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source%20Code%20Pro">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@1,700&display=swap">
    <script type="text/javascript" src="../../js/jquery-3.5.1.js"></script>
    <title>Ubah Data Admin</title>

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
    <div class="container" style="text-align: center; margin-top: 35px; margin-bottom: 35px;">
        <div class="card text-center panel bg-light">
            <div class="card-header">
                <ul class="nav nav-pills card-header-tabs justify-content-center" style="margin: 20px;">
                    <li style="font-family: Josefin Sans; text-align: center;">
                        <div class="h3">Data Pekerja</div>
                    </li>
                </ul>
            </div>
            <!-- disini masuk file terpisah -->
            <div class="card-body" align="center">
                <h3 class="card-title h3">Tambah Admin</h3><br />
                <form action="" method="POST" enctype="multipart/form-data" align="left" class="w-50">
                    <input type="hidden" name="id" value="<?php echo $id ?>" required>
                    <input type="hidden" name="akses" value="<?php echo $akses ?>" required>
                    <div class="form-group row">
                        <label for="nama" class="col-sm-4 col-form-label">Nama Lengkap </label>
                        <input type="text" name="nama" id="nama" class="form-control col-sm-7" placeholder="Masukan Nama Lengkap" required
                        value="<?php echo $namaLengkap ?>">
                    </div>
                    <div class="form-group row">
                        <label for="username" class="col-sm-4 col-form-label">username </label>
                        <input type="text" class="form-control col-sm-7" name="user" id="username" placeholder="Masukan username" required
                        value="<?php echo $user ?>">
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-4 col-form-label">Email </label>
                        <input type="email" class="form-control col-sm-7" name="email" id="email" placeholder="Tuliskan email" required
                        value="<?php echo $email ?>">
                    </div>
                    <div class="form-group row">
                    <label for="email" class="col-sm-4 col-form-label">Jenis Kelamin </label>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-light">
                                <input name="jk" value="Laki-laki" type="radio" <?php if($jk == "Laki-laki") echo "checked"?> required> Laki-laki
                            </label>
                            <label class="btn btn-light">
                                <input name="jk" value="Perempuan" type="radio"<?php if($jk != "Laki-laki") echo "checked"?> required> Perempuan
                            </label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jabatan" class="col-sm-4 col-form-label">jabatan</label>
                        <input type="text" class="form-control col-sm-7" name="jabatan" id="jabatan" placeholder="Karyawan" required
                        value="<?php echo $jabatan ?>">
                    </div>
                    <div class="form-group row">
                        <label for="foto" class="col-sm-4 col-form-label">
                        </label>
                        <div class="custom-file col-sm-4">
                        </div>
                        <div class="custom-file col-sm-4">
                            <img src="../img/<?php echo $fotoLama ?>" alt="fotoLama" style="width: 95px; height: 80;">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="foto" class="col-sm-4 col-form-label">Foto Profil
                            <small class="badge badge-pill badge-warning">Optional</small>
                        </label>
                        <div class="custom-file col-sm-4">
                            <input id="foto" type="file" name="foto" class="custom-file-input">
                            <input type="hidden" name="fotoLama" value="<?php echo $fotoLama ?>">
                            <label class="custom-file-label" for="foto">Pilih file</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-4 col-form-label">Password Baru</label>
                        <input type="hidden" name="passwordLama" value="<?php echo $password ?>">  
                        <input type="text" class="form-control col-sm-7" name="passwordBaru" id="password" placeholder="*********">
                    </div>
                    <div class="form-group row">
                        <label for="submit" class="col-sm-4 col-form-label"></label>
                        <button id="submit" type="submit" class="btn btn-primary" name="ubah">Confirm</button>
                    </div>
                </form>
            </div>

            <div class="card-footer text-muted" style="font-family: 'Courier New', Courier, monospace; font-size: 10pt">
                <b><?php echo format_hari(date("Y-m-d")); ?></b>
            </div>
        </div>
    </div>




</body>
<script src="../../js/bootstrap.min.js"></script>
<script src="../../libraries/moment/moment.min.js"></script>
<script src="../../libraries/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="../../js/custom.js"></script>

</html>