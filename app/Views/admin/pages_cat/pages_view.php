<?php
use Core\Language;
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Haber Ekleme <small>Preview</small>
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
			<div class="col-md-12">
				<!-- left column -->
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">Sayfalar</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<table class="table table-bordered">
							<tbody>
								<tr>
									<th>NO</th>
									<th>Başlık</th>
									<th >Olaylar</th>
								</tr>
					<?php
                    foreach ($pages as $value) {
                    ?>
                     <tr>
							<td><?php echo $value['id'];?></td>
							<td><?php echo $value['title'];?></td>
					
							<td>
							<a href="/admin/page_delete_cat/<?php echo $value['post_id'];?>" class="btn btn-info btn-sm"   title="" data-original-title="Düzenle">Sil</a>
							<a href="/admin/page_edit_cat/<?php echo $value['post_id'];?>" class="btn btn-info btn-sm"   title="" data-original-title="Düzenle">Düzenle</a></td>
						</tr>
				<?php } ?>
								
							</tbody>
						</table>
					</div>
					<!-- /.box-body -->
					<div class="box-footer clearfix">
						<ul class="pagination pagination-sm no-margin pull-right">
							<li><a href="#">«</a></li>
							<li><a href="#">1</a></li>
							<li><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">»</a></li>
						</ul>
					</div>
				</div>
			
			</div>
		</div>	<!--/.col md12  -->


	</section>

</div>
<!-- ./wrapper -->

<!-- /.content-wrapper -->