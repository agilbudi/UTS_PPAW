<div class="card-body" align="center">
    <h3 class="card-title h3">Login Admin</h3> <br/>
    <form action="" method="POST" align="left" class="w-50">
        <input type="hidden" name="akses" value="admin">
        <div class="form-group row">
            <label for="user" class="col-sm-4 col-form-label">Username</label>
            <input type="text" name="user" id="user" class="form-control col-sm-7" placeholder="Masukan Username" aria-describedby="iduser">
        </div>
        <div class="form-group row">
            <label for="password" class="col-sm-4 col-form-label">Password</label>
            <input type="password" class="form-control col-sm-7" name="password" id="password" placeholder="*********">
        </div>
        <div class="form-group row">
            <label for="submit" class="col-sm-4 col-form-label"></label>
            <button sid="submit" type="submit" class="btn btn-primary" name="login">LOGIN</button>
        </div>
    </form>
</div>