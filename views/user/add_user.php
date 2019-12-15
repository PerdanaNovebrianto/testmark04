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
              <h3 class="card-title">Add Data Users</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" action="<?= base_url()?>admin/user/ActionAdd" method="POST">
              <div class="card-body">
                <div class="form-group">
                  <label for="username">NIK</label>
                  <input type="text" class="form-control" name="nik" id="nik" placeholder="Enter NIK" value="<?= set_value('nik') ?>">
                  <span class="text-danger"><?= form_error('nik') ?></span>
                </div>
                <div class="form-group">
                  <label for="username">Username</label>
                  <input type="text" class="form-control" name="username" id="username" placeholder="Enter Username" value="<?= set_value('username') ?>">
                  <span class="text-danger"><?= form_error('username') ?></span>
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email" value="<?= set_value('email') ?>">
                  <span class="text-danger"><?= form_error('email') ?></span>
                </div>
                <div class="form-group">
                  <label for="phone">Phone</label>
                  <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter Phone" value="<?= set_value('phone') ?>">
                  <span class="text-danger"><?= form_error('phone') ?></span>
                </div>
                <div class="form-group">
                  <label for="location">Location</label>
                  <input type="text" class="form-control" name="location" id="location" placeholder="Enter Location" value="<?= set_value('location') ?>">
                  <span class="text-danger"><?= form_error('location') ?></span>
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" name="password" class="form-control" id="password" placeholder="Password" value="<?= set_value('password') ?>">
                  <span class="text-danger"><?= form_error('password') ?></span>
                </div>
                <div class="form-group">
                  <label for="dokterPuskesmas">Dokter Puskesmas</label>
                    <select class="form-control" name="dokterPuskesmas" id="dokterPuskesmas">
                      	<option value=""> Pilih Puskesmas </option>
                  	<?php
                  		foreach ($puskesmas as $key) {
                  			?> 
                  				<option value="<?= $key->id_puskesmas ?>"> <?= $key->nama ?></option>
                  			<?php
                  		}
                  	?>
                  </select>
                  <span class="text-danger"><?= form_error('dokterPuskesmas') ?></span>
                </div>
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