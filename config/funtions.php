<?php
error_reporting(E_ALL ^ E_DEPRECATED);
$host = "localhost";
$user = "root";
$pass = "";
$dbName = "datapekerja";

$connect = mysqli_connect($host, $user, $pass) or die("gagal koneksi..."); //konek ke mysqlnya

$pilihDB = mysqli_select_db($connect, $dbName); //pilih database
if (!$pilihDB) {
    $pilihDB = mysqli_query($connect, "CREATE DATABASE $dbName"); //buat database
    if (!$pilihDB) {
        die("gagal buat database...");
    } else {
        $pilihDB = mysqli_select_db($connect, $dbName); //pilih database
        if (!$pilihDB) {
            die("gagal konek ke database...");
        }
    }
}
require 'namatable.php';

function query($query) {
    global $connect;
    $jadi = mysqli_query($connect, $query);
    return $jadi;
}
function query_getData($query){
    global $connect;
    $select = mysqli_query($connect, $query); //select * data
    $view = [];
    while ( $row = mysqli_fetch_assoc($select)) {
        $view[] = $row;
    }
    return $view; 
}

function create($data){
    global $connect;
    $akses = $data["akses"];
    $user = htmlspecialchars($data["user"]);
    $namaLengkap = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $jk = $data["jk"];
    $jabatan = htmlspecialchars($data["jabatan"]);
    $foto = imageProses($akses);
    if (!$foto) {
    $foto = "profil_default.png";
        return false;
    }
    $inputPassword = mysqli_real_escape_string($connect,$data["password"]);
    $akses = $data["akses"];
    
    $emailCheck = query("SELECT email FROM pekerja WHERE email = '$email'");
    $userCheck = query("SELECT user FROM pekerja WHERE user = '$user'");
    $password = md5($inputPassword);
    if (mysqli_fetch_assoc($emailCheck)) {
        echo "<script>
        alert('Email sudah ada!');
        </script>";
        return false;
    }
    if (mysqli_fetch_assoc($userCheck)) {
        echo "<script>
        alert('User sudah ada!');
        </script>";
        return false;
    }

    mysqli_query($connect,"INSERT INTO pekerja VALUES
        ('', '$user', '$namaLengkap', '$email',
        '$jk', '$jabatan', '$foto', '$password', '$akses')");
    return mysqli_affected_rows($connect);
}

function update($data){
    global $connect;

    $id = $data["id"];
    $pengakses = $_SESSION["akses"];
    $user = htmlspecialchars($data["user"]);
    $namaLengkap = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $jk = $data["jk"];
    $jabatan = htmlspecialchars($data["jabatan"]);
    $fotoLama = $data["fotoLama"];
    $foto = imageProses($pengakses);
    if (!$foto) {
    $foto = $fotoLama;
    }
    $password = "";
    $passwordBaru = mysqli_real_escape_string($connect,$data["passwordBaru"]);
    $passwordLama = $data["passwordLama"];
    if ($passwordBaru) {
        $encrip = md5($passwordBaru);
        $password = $encrip;
    }else {
        $password = $passwordLama;
    }
    $akses = $data["akses"];
    $userData = query_getData("SELECT * FROM pekerja WHERE id = '$id'");
    
    $emailCheck = query("SELECT email FROM pekerja WHERE email = '$email'");
    $userCheck = query("SELECT user FROM pekerja WHERE user = '$user'");
    if (!mysqli_fetch_assoc($emailCheck)) {
        if ($email != $userData["email"]) {
            echo "<script>
            alert('Email sudah ada!');
            </script>";
            return false;
        }
    }
    if (!mysqli_fetch_assoc($userCheck)) {
        if ($user != $userData["user"]) {
            echo "<script>
            alert('User sudah ada!');
            </script>";
            return false;
        }
    }

    mysqli_query($connect, "UPDATE pekerja SET user = '$user',
            namaLengkap = '$namaLengkap', email = '$email', jk = '$jk',
            jabatan = '$jabatan', foto = '$foto', password = '$password',
            akses = '$akses'
            WHERE id = $id");
    
    return mysqli_affected_rows($connect);
}

function delete($data){
    global $connect;
    if ($data == 1) {
        return false;
    }else {
        query("DELETE FROM pekerja WHERE id = $data");
        return mysqli_affected_rows($connect);
    }
}

function format_hari($waktu){
    $hari_array = array('Minggu','Senin','Selasa','Rabu',
        'Kamis','Jumat','Sabtu');
    $hr = date('w', strtotime($waktu));

    $bulan_array = array(1 => 'Januari', 2 => 'Februari',
        3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni',
        7 => 'Juli', 8 => 'Agustus', 9 => 'September',
        10 => 'Oktober', 11 => 'November', 12 => 'Desember');
    $bl = date('n', strtotime($waktu));
    
    $hari = $hari_array[$hr];
    $email = date('j', strtotime($waktu));
    $bulan = $bulan_array[$bl];
    $tahun = date('Y', strtotime($waktu));
    $jam = date( 'H:i:s', strtotime($waktu));
    
    //untuk menampilkan hari, email bulan tahun jam
    //return "$hari, $email $bulan $tahun $jam";

    //untuk menampilkan hari, email bulan tahun
    return "$hari, $email $bulan $tahun";
}
function imageProses($akses){
    $namaFile = $_FILES['foto']['name'];
    $ukuranFile = $_FILES['foto']['size'];
    $errorFile = $_FILES['foto']['error'];
    $tmpFile = $_FILES['foto']['tmp_name'];

    if ($errorFile == 4) {             //jika kosong ganti dengan defauld gambar
        return "profil_default.png";
    }else {
        $ekstensi = ['jpg','jpeg','png'];                   //hanya file gambar
        $ekstensiFile = explode('.',$namaFile);
        $ekstensiFile = strtolower(end($ekstensiFile));
        if (!in_array($ekstensiFile, $ekstensi)) {
            echo "<script>
            alert('Data yang di ambil bukan gambar!');
            </script>";
            return false;
        }

        if ($ukuranFile > 1500000) {
            echo "<script>
            alert('Gambar lebih besar dari 1,5 mb!');
            </script>";
            return false;
        }

        $namaFileBaru = uniqid();
        $namaFileBaru .= '.';
        $namaFileBaru .= $ekstensiFile;
        if ($akses == "admin") {
            move_uploaded_file($tmpFile, '../../resource/img/'.$namaFileBaru);
        }else {
            move_uploaded_file($tmpFile, 'resource/img/'.$namaFileBaru);
        }
        return $namaFileBaru;
    }
}
?>