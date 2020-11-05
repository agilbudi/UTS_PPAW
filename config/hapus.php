<?php
require 'funtions.php';

$id = $_GET["id"];
$tabel = $_GET["name"];

if ($uu = delete($id, $tabel) > 0) {
    echo "<script>
        document.location.href= 'index.php';
        </script>";
}else {
    echo "<script>
        alert('Data gagal dihapus!');
        </script>";
        var_dump($uu); die;
}
        //document.location.href= 'dataMhs.php';
?>