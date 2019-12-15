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
          <?php
            if( $this->session->flashdata('respon') )
            {
              ?>
                <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <i class="icon fa fa-check"></i> Selamat! <?php echo $this->session->flashdata('respon'); ?>
                </div>
              <?php
            }
          ?>
        </div>
        <div class="card-body">
          <a href="<?= base_url() ?>admin/user/add" class="btn btn-primary mt-2 mb-4"><i class="fa fa-plus"></i> Add </a>
          <table id="data-users" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th width="6%">#</th>
                <th width="14%">Username</th>
                <th width="15%">Email</th>
                <th width="15%">Phone</th>
                <th width="15%">Location</th>
                <th width="17%">Dokter Puskesmas</th>
                <th width="8%">NIK</th>
                <th width="8%"></th>
              </tr>
            </thead>
            <tbody>
              <?php
                $no = 1;
                foreach ($user as $key) {
              ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= $key->username ?></td>
                <td><?= $key->email ?></td>
                <td><?= $key->phone ?></td>
                <td><?= $key->location ?></td>
                <td><?php if( $key->nama == "" ) { echo $key->dokter_puskesmas; } else { echo $key->nama; } ?></td>
                <td><?= $key->nik ?></td>
                <td>
                    <a href="<?= base_url() ?>admin/user/update/<?= $key->id ?>" class="btn btn-success btn-block" style="margin-bottom: 5px;"><i class="fa fa-edit"></i> Update </a>
                    <form action="<?= base_url() ?>admin/user/delete/<?= $key->id ?>" method="POST">
                      <button type="submit" name="btnSimpan" onclick="return confirm('Yakin ingin menghapus data ini ?')" class="btn btn-danger btn-block"><i class="fa fa-trash"></i> Delete </button>
                    </form>
                </td>
              </tr>
              <?php } ?>
            </tbody>
            <tfoot>
              <tr>
                <th>#</th>
                <th>Username</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Location</th>
                <th>Dokter Puskesmas</th>
                <th></th>
                <th></th>
              </tr>
              </tfoot>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->