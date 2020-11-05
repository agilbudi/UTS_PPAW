<?php
require '../../config/funtions.php';

$id = $_GET["id"];
if ($hasil = delete($id) > 0) {
    echo "<script>
        document.location.href= '../../admin.php';
        </script>";
}else {
    echo "<script>
        alert('Obat gagal dihapus!');
        document.location.href= '../../admin.php';
        </script>";
        var_dump($hasil);
}
?>