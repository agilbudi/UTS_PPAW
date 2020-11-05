<?php
session_start();
$sesi = $_SESSION["akses"];
if ($sesi != "user") {
        header("Location: index.php");
        exit;
}
include 'config/funtions.php';
$showPekerja = query_getData("SELECT * FROM pekerja ORDER BY namaLengkap ASC")
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
    <title>Daftar Pekerja by <?php echo $sesi ?></title>

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
    <div class="container" style="text-align: center; margin-top: 35px;">
        <div class="card text-center panel bg-light">
            <div class="card-header">
                <ul class="nav nav-pills card-header-tabs justify-content-end">
                        <li style="font-family: Josefin Sans; text-align: end;">
                            <b><?php echo $_SESSION["user"] ?></b>
                        </li>
                </ul>
                <ul class="nav nav-pills card-header-tabs justify-content-center" style="margin: 20px;">
                    <li style="font-family: Josefin Sans; text-align: center;">
                        <div class="h3">Data Pekerja</div>
                    </li>
                </ul>
                <ul class="nav nav-pills card-header-tabs justify-content-end">
                    <li class="nav-item">
                        <a href="resource/page/logout.php" class="nav-link menu text-white btn-danger" id="logout">Logout</a>
                    </li>
                </ul>
                <ul class="nav nav-tabs card-header-tabs bg-secondary" style="border-radius: 5px;">
                    <li class="nav-item">
                        <a class="nav-link menu" id="user">user</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu disabled" id="admin">admin</a>
                    </li>
                </ul>
            </div>
            <!-- disini masuk file terpisah -->
            <div class="card-body" align="center">
                        <table class="table table-sm table-striped table-light" style="border-radius: 10px;">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>FOTO</th>
                                    <th>NAMA</th>
                                    <th>EMAIL</th>
                                    <th>JENIS KELAMIN</th>
                                    <th>JABATAN</th>
                                    <th style="text-align: center;">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php if (!$showPekerja)
                                    echo "<tr>
                                    <td colspan='7' style='text-align: center;'>Data Masih Kosong...</td></tr>"; ?>
                                <?php foreach ($showPekerja as $row) : ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td> <a href="<?php echo "resource/img/{$row['foto']}" ?>"> <img <?php echo "src='resource/img/{$row['foto']}'" ?> style="width: 35px; height: 35px;" alt="ok"/></a></td>
                                        <td><?= $row["namaLengkap"] ?></td>
                                        <td><?= $row["email"] ?></td>
                                        <td><?= $row["jk"] ?></td>
                                        <td><?= $row["jabatan"] ?></td>
                                        <td style="text-align: center;">-</td>
                                    </tr>
                                <?php $i++; endforeach; ?>
                            </tbody>
                        </table>
            </div>

            <div class="card-footer text-muted" style="font-family: 'Courier New', Courier, monospace; font-size: 10pt">
                <b><?php echo format_hari(date("Y-m-d")); ?></b>
                <br>© Made with <small class="text-danger">❤</small> for <b>YOU</b> by <a href="https://berikhtiar.com/hide.980" class='text-primary' target='_blank'><b>HiDe09</b></a>
            </div>
        </div>
    </div>




</body>
<script type="text/javascript">
    $(document).ready(function() {
        // halaman yang di load default pertama kali
        $('#user').addClass('active');
    });
</script>
<script src="js/bootstrap.min.js"></script>
<script src="libraries/moment/moment.min.js"></script>
<script src="libraries/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="js/custom.js"></script>

</html>