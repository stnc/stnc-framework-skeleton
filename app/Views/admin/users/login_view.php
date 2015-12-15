    <?php
Lib\Assets::css(array(
    'https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css',
		Lib\Url::publicPath() . '/admin/plugins/iCheck/square/blue.css',
));
    ?>
<body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="../../index2.html"><b>Save As </b>Panel</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <form action="../../index2.html" method="post">
          <div class="form-group has-feedback">
            <input type="email" class="form-control" placeholder="Email">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">

            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div><!-- /.col -->
          </div>
        </form>


        <a href="#">I forgot my password</a><br>
        <a href="register.html" class="text-center">Register a new membership</a>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
    
    


<?php
/*

Lib\Assets::css(array(
    'https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css',
		Lib\Url::publicPath() . '/admin/plugins/iCheck/square/blue.css',
));

Lib\Assets::js(array(
    Lib\Url::publicPath() .'/admin/plugins/iCheck/icheck.min.js'
));

*/
?>
    
<script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>