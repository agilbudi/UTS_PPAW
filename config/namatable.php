<?php
    $sqlTablePekerja = "CREATE TABLE IF NOT EXISTS pekerja (
        id int auto_increment not null primary key,
        user varchar(15) not null,
        namaLengkap varchar(30) not null,
        email varchar(30) not null,
        jk enum('Laki-laki','Perempuan') not null,
        jabatan varchar(30) not null,
        foto varchar(50) not null,
        password varchar(200) not null,
        akses enum('user','admin') not null,
        KEY(id))";
    query($sqlTablePekerja) or die ("Gagal buat tabel pekerja");

    $hasil = query("SELECT * FROM pekerja");
    $jumlah = mysqli_num_rows($hasil);
    if ($jumlah == 0) {
        query("INSERT INTO pekerja VALUES
        ('', 'agil', 'Agil Budi Prasetyo', 'agilbudiprasetyo@gmail.com', 
        'Laki-laki', 'CEO', 'profil_default.png', md5('admin'),
        'admin')");
    }
?>