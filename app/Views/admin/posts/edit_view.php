<script>

function ekle (){
	$( "#upload" ).append( '<input type="file" class="textbox-value"  name="uploadPic[]"><br>' );
	}
	
$(function () {


      //  CKEDITOR.replace('content>');
        // $("#content").wysihtml5();



    
  });
</script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo $_setting['view_page_name']?> Düzenleme <small>Preview</small>
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
echo \Lib\Session::pull('message');
echo \Lib\Error::display($error);

?>
		
    <div id="warning_error" style="display: none"
				class="alert alert-danger"></div>
			<div id="warning_ok" style="display: none"
				class="alert alert-success"></div>


			<!-- left column -->
			<!-- left column -->
			<div class="col-md-12">
				<div class="nav-tabs-custom">
					<!-- Tabs within a box -->
					<ul class="nav nav-tabs pull-right">





						<li class="pull-left header"><i class="fa fa-inbox"></i> <?php echo $_setting['view_page_name']?>	Düzenleme</li>
					</ul>
					<form role="form" method="post" enctype="multipart/form-data"
						action="/admin/<?php echo $_setting['post_name']?>_edit/<?php echo $post_id?>"
						id="posts">



                <?php
                include 'include_edit.php';
                ?>
   

				
				</div>



				</form>

				<!--/.col md12  -->
			</div>
	
	</section>

</div>
<!-- ./wrapper -->

<!-- /.content-wrapper -->


<script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>

