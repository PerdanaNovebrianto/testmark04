<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Registration Page</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/adminlte.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/iCheck/square/blue.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="<?= base_url() ?>assets/index2.html"><b>Tanya</b>Dokter</a>
  </div>
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
  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new membership</p>

      <form action="<?= base_url()?>auth/actionRegister" method="POST">
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
          <label for="confirmPassword">Confirm Password</label>
          <input type="password" name="confirmPassword" class="form-control" id="confirmPassword" placeholder="Password" value="<?= set_value('confirmPassword') ?>">
          <span class="text-danger"><?= form_error('confirmPassword') ?></span>
        </div>
        <div class="form-group">
          <label for="dokterPuskesmas">Dokter Puskesmas</label>
          <input type="text" class="form-control" name="dokterPuskesmas" id="dokterPuskesmas" placeholder="Enter Location" value="<?= set_value('dokterPuskesmas') ?>">
          <span class="text-danger"><?= form_error('dokterPuskesmas') ?></span>
        </div>
        <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
          </div>
      </form>

      <div class="social-auth-links text-center">
        <p>- OR -</p>
        <a href="<?= base_url() ?>auth" class="float-right btn btn-success btn-block">Login</a>
      </div>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="<?= base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- iCheck -->
<script src="<?= base_url() ?>assets/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass   : 'iradio_square-blue',
      increaseArea : '20%' // optional
    })
  })
</script>
</body>
</html>
