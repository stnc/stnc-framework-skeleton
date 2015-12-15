<?php
use Core\Language;
?>
<script>
function ekle (){
$( "#upload" ).append( '<input type="file" class="textbox-value"  name="uploadPic[]"><br>' );
}
//mmantık şu ajaxdan datayı gonder
//get parametresi ile tr ve en gitsin
//db deki yer bu parametreye gore ek yaparak kayıt yapsın


	function TurkceInput(okunan_alan,ara_karakter) {
	    var charMap = {Ç:'c',Ö:'o',Ş:'s',İ:'i',I:'i',Ü:'u',Ğ:'g',ç:'c',ö:'o',ş:'s',ı:'i',ü:'u',ğ:'g', ".":'_'};
	    var str = $('#'+okunan_alan).val();
	    str_array = str.split('');
	    for(var i=0, len = str_array.length; i < len; i++) {
	        str_array[i] = charMap[ str_array[i] ] || str_array[i];
	    }
	    str = str_array.join('');
	     var clearStr = str.replace( / /gi,ara_karakter).replace(/--/gi,ara_karakter).replace(/[^a-z0-9-.çöşüğı]/gi,ara_karakter).replace("--","-").toLowerCase();
	   $("#slug").val(clearStr);
	   //  $('#'+okunan_alan).parent().next().children("input").val(clearStr);
	}


$(function() {


	       
				$("#title").keyup(function() {
					TurkceInput($(this).attr('id'),"_");
				});

			    //CKEDITOR.replace('content');
				 //    $("#content>").wysihtml5();
		
			
});
</script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo $_setting['view_page_name']?> Ekleme <small>Preview</small>
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
			<!-- left column -->
			<!-- left column -->
			<div class="col-md-12">

						
				
						<li class="pull-left header">
						<i class="fa fa-inbox"></i> <?php echo $_setting['view_page_name']?>	Ekleme
						</li>
					</ul>
					<form role="form" method="post" enctype="multipart/form-data"
						action="/admin/<?php echo $_setting['post_name']?>_add" id="post">


			
				

        

        <?php
        include 'include_add.php';
        ?>
         

				
      
				</div>




						<div class="box-footer clearfix">
							<button class="pull-right btn btn-default"
								style="margin-top: 44px;" type="submit" id="save_button">
								Kaydet <i class="fa fa-arrow-circle-right"></i>
							</button>
						</div>
					</form>
		
			<!--/.col md12  -->
		</div>


	</section>

</div>
<!-- ./wrapper -->

<!-- /.content-wrapper -->

<script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>