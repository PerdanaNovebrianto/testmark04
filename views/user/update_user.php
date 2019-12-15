  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?= $title ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="">Home</a></li>
              <li class="breadcrumb-item active"><?= $sub_title ?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title"><?= $sub_title ?></h3>

          <div class="card-tools">
            <a href="<?= base_url() ?>admin/user" class="btn btn-tool">
              <i class="fa fa-times"></i>
            </a>
          </div>
        </div>
        <div class="card-body">
         <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Update Data Users</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" action="<?= base_url()?>admin/user/ActionUpdate" method="POST">
              <div class="card-body">
                <?php foreach ($user as $key) { ?>
                <div class="form-group">
                  <input type="hidden" name="id" value="<?= $key->id ?>">
                  <input type="hidden" name="old_nik" value="<?= $key->nik ?>">
                  <input type="hidden" name="old_username" value="<?= $key->username ?>">
                  <input type="hidden" name="old_email" value="<?= $key->email ?>">
                  <input type="hidden" name="old_phone" value="<?= $key->phone ?>">
                  <label for="nik">NIK</label>
                  <input type="text" class="form-control" name="nik" id="nik" placeholder="Enter NIK" value="<?= $key->nik ?>">
                  <span class="text-danger"><?= form_error('nik') ?></span>
                </div>
                <div class="form-group">
                  <label for="username">Username</label>
                  <input type="text" class="form-control" name="username" id="username" placeholder="Enter Username" value="<?= $key->username ?>">
                  <span class="text-danger"><?= form_error('username') ?></span>
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email" value="<?= $key->email ?>">
                  <span class="text-danger"><?= form_error('email') ?></span>
                </div>
                <div class="form-group">
                  <label for="phone">Phone</label>
                  <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter Phone" value="<?= $key->phone ?>">
                  <span class="text-danger"><?= form_error('phone') ?></span>
                </div>
                <div class="form-group">
                  <label for="location">Location</label>
                  <input type="text" class="form-control" name="location" id="location" placeholder="Enter Location" value="<?= $key->location ?>">
                  <span class="text-danger"><?= form_error('location') ?></span>
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" name="password" class="form-control" id="password" placeholder="Password" value="<?= set_value('password') ?>">
                  <span class="text-danger">* Kosongkan apabila tidak ingin ganti password</span>
                </div>
                <div class="form-group">
                  <label for="dokterPuskesmas">Dokter Puskesmas</label>
                  <input type="text" class="form-control" name="dokterPuskesmas" id="dokterPuskesmas" placeholder="Enter Location" value="<?= $key->dokter_puskesmas ?>">
                  <span class="text-danger"><?= form_error('dokterPuskesmas') ?></span>
                </div>
                <?php } ?>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" name="btnSimpan" class="btn btn-primary">Simpan</button>
              </div>
            </form>
          </div>
        </div>
        <!-- /.card-body -->
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->