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
            <a href="<?= base_url() ?>admin/info" class="btn btn-tool">
              <i class="fa fa-times"></i>
            </a>
          </div>
        </div>
        </div>
        <div class="card-body">
         <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Update Data Tips Kesehatan</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" action="<?= base_url()?>admin/tips/ActionUpdate" method="POST" enctype="multipart/form-data">
              <div class="card-body">
                <?php foreach ($tips as $key) { ?>
                <div class="form-group">
                  <input type="hidden" name="id" value="<?= $key->id ?>">
                  <input type="hidden" name="old_image" value="<?= $key->gambar ?>">
                  <label for="judul">Judul</label>
                  <input type="text" class="form-control" name="judul" id="judul" placeholder="Enter Judul" value="<?= $key->judul ?>">
                  <span class="text-danger"><?= form_error('judul') ?></span>
                </div>
                <div class="form-group">
                  <label for="isi">Isi</label>
                  <textarea name="isi" class="form-control" rows="8" style="width: 100%;" placeholder="Enter Isi"><?= $key->isi ?></textarea>
                  <span class="text-danger"><?= form_error('isi') ?></span>
                </div>
                <div class="form-group">
                  <label for="pengarang">Pengarang</label>
                  <input type="text" class="form-control" name="pengarang" id="pengarang" placeholder="Enter Pengarang" value="<?= $key->pengarang ?>">
                  <span class="text-danger"><?= form_error('pengarang') ?></span>
                </div>
                <div class="form-group">
                  <label for="tanggal">Tanggal</label>
                  <input type="date" class="form-control" name="tanggal" id="tanggal" placeholder="Enter Tanggal" value="<?= $key->tanggal ?>">
                  <span class="text-danger"><?= form_error('tanggal') ?></span>
                </div>
                <div class="form-group">
                  <label for="gambar">Gambar</label>
                  <input type="file" name="gambar" class="form-control" id="gambar" placeholder="Gambar" accept="image/*">
                  <?php if(!empty($error)){?>
                    <span class="text-danger"><?= $error; ?></span>
                  <?php } ?>
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