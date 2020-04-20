<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>login | PPG Jakarta Pusat</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- favicon -->
  <link rel="shortcut icon" href="<?=BASEURL?>img/logoPPG.jpeg" type="image/x-icon">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=BASEPATH?>vendor/almasaeed2010/adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=BASEPATH?>vendor/almasaeed2010/adminlte/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition lockscreen">
<!-- Automatic element centering -->
<div class="lockscreen-wrapper">
  <div class="lockscreen-logo">
    <a href="<?=BASEURL?>">Presensi Online</a>
  </div>
  <!-- User name -->
  <div class="lockscreen-name">
    Administrator
    <?=isset($_SESSION['presensi_wrong']) ? '<p class="text-sm text-danger">Password invalid</p>' : '' ; ?>
  </div>


  <!-- START LOCK SCREEN ITEM -->
  <div class="lockscreen-item">
    <!-- lockscreen image -->
    <div class="lockscreen-image">
      <img src="<?=BASEURL?>/img/logoPPG.jpeg" alt="User Image">
    </div>
    <!-- /.lockscreen-image -->

    <!-- lockscreen credentials (contains the form) -->
    <form action="<?=BASEURL?>auth/authorization" method="post" class="lockscreen-credentials">
      <div class="input-group">
        <input type="password" class="form-control <?=isset($_SESSION['presensi_wrong']) ? 'is-invalid' : '' ; ?>" placeholder="password" name="presensi_password">

        <div class="input-group-append">
          <button type="button" class="btn"><i class="fas fa-arrow-right text-muted"></i></button>
        </div>
      </div>
    </form>
    <!-- /.lockscreen credentials -->

  </div>
  <!-- /.lockscreen-item -->
  <div class="help-block text-center">
    Enter your password to entry
  </div>
  <div class="text-center">
    <a href="<?=BASEURL?>">Or want to go homepage</a>
  </div>
  <div class="lockscreen-footer text-center">
    Copyright &copy;<b><a href="" class="text-black">PPG Jakpus</a></b><br>
  </div>
</div>
<!-- /.center -->

<!-- jQuery -->
<script src="<?=BASEPATH?>vendor/almasaeed2010/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?=BASEPATH?>vendor/almasaeed2010/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
