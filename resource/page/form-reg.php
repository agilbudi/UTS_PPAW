<div class="card-body" align="center">
    <h3 class="card-title h3">Tambah User</h3><br />
    <form action="" method="POST" enctype="multipart/form-data" align="left" class="w-50">
        <input type="hidden" class="form-control col-sm-7" name="akses" value="user" required>
        <div class="form-group row">
            <label for="nama" class="col-sm-4 col-form-label">Nama Lengkap </label>
            <input type="text" name="nama" id="nama" class="form-control col-sm-7" placeholder="Masukan Nama Lengkap" required>
        </div>
        <div class="form-group row">
            <label for="username" class="col-sm-4 col-form-label">username </label>
            <input type="text" class="form-control col-sm-7" name="user" id="username" placeholder="Masukan username" required>
        </div>
        <div class="form-group row">
            <label for="email" class="col-sm-4 col-form-label">Email </label>
            <input type="email" class="form-control col-sm-7" name="email" id="email" placeholder="Tuliskan email" required>
        </div>
        <div class="form-group row">
        <label for="email" class="col-sm-4 col-form-label">Jenis Kelamin </label>
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-light">
                    <input name="jk" value="Laki-laki" type="radio" checked required> Laki-laki
                </label>
                <label class="btn btn-light">
                    <input name="jk" value="Perempuan" type="radio" required> Perempuan
                </label>
            </div>
        </div>
        <div class="form-group row">
            <label for="jabatan" class="col-sm-4 col-form-label">jabatan</label>
            <input type="text" class="form-control col-sm-7" name="jabatan" id="jabatan" placeholder="Karyawan" required>
        </div>
        <div class="form-group row">
            <label for="foto" class="col-sm-4 col-form-label">Foto Profil
                <small class="badge badge-pill badge-warning">Optional</small>
            </label>
            <div class="custom-file col-sm-4">
                <input type="file" class="custom-file-input" name="foto" id="foto">
                <label class="custom-file-label" for="customFile">Pilih Foto</label>
            </div>
        </div>
        <div class="form-group row">
            <label for="password" class="col-sm-4 col-form-label">Password Baru</label>
            <input type="text" class="form-control col-sm-7" name="password" id="password" placeholder="*********">
        </div>
        <div class="form-group row">
            <label for="submit" class="col-sm-4 col-form-label"></label>
            <button id="submit" type="submit" class="btn btn-primary" name="tambah">Confirm</button>
        </div>
    </form>
</div>