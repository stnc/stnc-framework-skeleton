

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
					 <?php
    
    $a = 0;
    foreach ($languages as $value) {
        $a ++;
        if ($a == 1) {
            $class = "active";
        } else {
            $class = "";
        }
        ?>
						<li class="<?php echo $class?>"><a
							href="#<?php
        
        echo $value['slug'];
        ?>"
							data-toggle="tab"><?php echo strtoupper( $value['slug']);?></a></li>
						
					<?php } ?>
						
						<li class="pull-left header"><i class="fa fa-inbox"></i> <?php echo $_setting['view_page_name']?>	Düzenleme</li>
					</ul>
					<form role="form" method="post"
						action="/admin/<?php echo $_setting['post_name']?>_edit/<?php echo $post_id?>" id="posts">

						<div class="tab-content no-padding">
				
	
				<?php
    
    $y = 0;
    foreach ($languages as $value) {
        $y ++;
        if ($y == 1) {
            $class = "active";
        } else {
            $class = "";
        }
        
        $lng = $value['slug'];
        $language = $value['language'];
        ?>
				<div class=" tab-pane <?php echo $class?>"
								id="<?php echo $lng?>"
								style="position: relative; height: 600px;">
                <?php
        include 'include_edit.php';
        ?>
                </div>

				
              <?php } ?>
				</div>
				
				
					
						
						<div class="box-footer clearfix">
							<button class="pull-right btn btn-default"
								style="margin-top: 44px;" type="submit" id="save_button">
								Güncelle <i class="fa fa-arrow-circle-right"></i>
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
