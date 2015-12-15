<?php
use Core\Language;
?>
<script>





$(function() {


	
    $(".textarea").wysihtml5();
//https://ideal.com.tr/public/js/adresler.js
//https://test.ideal.com.tr/public/script.js
/*    	adet=$(".content form").length;
    	console.log(adet);
    	$.each($('.content form'), function(index, value) {
    	console.log($(this).attr("id"));
    	var id=$(this).attr("id");
    	console.log($('.content #'+id).serialize());  	});*/
 // adres
 
    $("#save_button").on("click", function() {
    	  var form = $('.content #pages');
    	  $.ajax({
    	      type: form.attr('method'),
              url: form.attr('action'),
              data: form.serialize(),

              success: function(result) {
            	   json = JSON.parse(result);
            	   if (json.returns != 'ok') {
                       $("#warning_error").show();
                       $("#warning_ok").hide();
                       $("#warning_error").html('Beklenmeyen bir hata oluştu');

                   } else if (json.returns == "ok") {
                	    $("#warning_ok").show();
                	    $("#warning_error").hide();
                        $("#warning_ok").html('Kayıt yapıldı');
                     }
              }
          
          });

    });
});
</script>
  <body class="hold-transition skin-blue sidebar-mini">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Haber Düzenleme <small>Preview</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="#">Forms</a></li>
			<li class="active">General Elements</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
		
		<?php
		echo \Lib\Session::pull ( 'message' );
		echo \Lib\Error::display ( $error );
		
		?>
		
    <div id="warning_error" style="display: none" class="alert alert-danger"></div>
	<div id="warning_ok" style="display: none"	class="alert alert-success"></div>
		
		
			<!-- left column -->
			<div class="col-md-12">
				<div class="nav-tabs-custom">
					<!-- Tabs within a box -->
					<ul class="nav nav-tabs pull-right">
						<li class="active"><a href="#tr" data-toggle="tab">TR</a></li>
						<li><a href="#en" data-toggle="tab">EN</a></li>
						<li class="pull-left header"><i class="fa fa-inbox"></i> Sayfa
							Düzenleme</li>
					</ul>
					<form role="form" method="post" action="/admin/AjaxNewsedit" id="pages">
						<div class="tab-content no-padding">

							<div class=" tab-pane active" id="tr"
								style="position: relative; height: 600px;">
				  <input type="hidden" name="post_id"	value="<?php echo $lang_tr['post_id']?>">
				  
                  <?php
                  $language="tr";
                  include 'include_edit.php';?>
                  </div>

							<div class=" tab-pane" id="en"
								style="position: relative; height: 600px;">
                   <?php
                   $language="en";
                   include 'include_edit.php';?>
                  </div>



						</div>
						<div class="box-footer clearfix">
							<button class="pull-right btn btn-default"
								style="margin-top: 44px;" type="button" id="save_button">
								Save <i class="fa fa-arrow-circle-right"></i>
							</button>
						</div>
					</form>
				</div>
				<!-- /.nav-tabs-custom -->


			</div>
			<!--/.col md12  -->
		</div>


	</section>

</div>
<!-- ./wrapper -->

<!-- /.content-wrapper -->