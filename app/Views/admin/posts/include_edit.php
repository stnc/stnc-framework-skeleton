<style type="text/css">
.thumbnail {
	float: left;
	display: block;
	padding: 4px;
	line-height: 1.42857;
	background-color: #f3f3f3;
	border: 1px solid #ddd;
	border-radius: 2px;
	-webkit-transition: border 0.2s ease-in-out;
	-o-transition: border 0.2s ease-in-out;
	transition: border 0.2s ease-in-out;
	width: 150px;
	height: 100px;
	cursor: pointer;
}

.kapsayici {
	margin-bottom: 20px;
	margin-left: 36px;
	float: left;
}

.controls {
	background-color: #1b1b1b;
	text-align: center;
	float: left;
	width: 160px;
}

.controls a {
	display: inline-block;
	padding: 0 5%;
	height: 25px;
	line-height: 26px;
	font-size: 15px;
	font-weight: 300;
	color: #888;
}
</style>


<script type="text/javascript">
function ResimSil(id) {
    $.ajax({
        url: '/admin/picture_delete/' + id,
        // dataType: 'json',
        success: function(data) {
            if (data == 'ok') {
                    $(".kapsayiciGImages" + id).remove();
            } else {
               alert( 'Bir sorun oluştu');
            }
        }
    });
};
</script>

<div class="box-body">




	<input type="hidden" name="post_id"
		value="<?php echo $post['post_id']?>">



	<div class="form-group">
		<label>Kategori</label> <select name="cat_id" class="form-control">
		       <?php
        foreach ($categories as $val) {
            if ($lang['tr']['cat_id'] == $val['cat_id']) {
                echo '<option   selected="selected"  value="' . $val['cat_id'] . '">' . $val['cat_title'] . '</option>';
            } else {
                echo '<option value="' . $val['cat_id'] . '">' . $val['cat_title'] . '</option>';
            }
        }
        ?>
                </select>
	</div>

	<div class="form-group">
		<label for="title">Başlık</label> <input type="text"
			class="form-control" name="title" id="title"
			value="<?php echo $post['title']?>" placeholder="Başlık">
	</div>

	<div class="form-group">
		<label for="slug">Slug</label> <input type="text" class="form-control"
			name="slug" value="<?php echo $post['slug']?>" readonly="readonly"
			id="slug" placeholder="Slug">
	</div>

	<div class="form-group">
		<label for="description">Açıklama</label> <input type="text"
			class="form-control" name="description"
			value="<?php echo $post['description']?>" id="description"
			placeholder="Açıklama">
	</div>


	<div class="form-group">
		<label for="content">İçerik</label>

		<textarea class="form-control textarea"
			style="height: 310px; width: 1238px;" id="content" name="content"
			rows="10" cols="80">
	   <?php echo htmlentities($post['content'])?></textarea>
	</div>


	<div id="Gimages" region="center" style="padding: 5px;">
		<?php     foreach ($pictures as $value) {?>
		<div class="kapsayici kapsayiciGImages<?php echo $value['photo_id']?>">

			<div class="controls">

				<a href="javascript:void(0)"
					onclick="ResimSil('<?php echo $value['photo_id']?>')" title="Sil">
					<i class="fa fa-times"></i>
				</a> <img title="" class="thumbnail"
					src="/public/resimler/urunler/<?php echo $value['photo_filename'] ?>">

			</div>
		</div>
		<?php } ?>
		
	</div>


	<div class="box-footer clearfix">
		<button class="pull-left btn btn-default" onclick="ekle()"
			type="button" id="save_button">RESİM EKLE</button>
	</div>


	<div id="upload" class="box-footer clearfix">
		<input type="file" class="textbox-value"
			class="btn btn-default btn-file" name="uploadPic[]"></br>
	</div>

	<div class="box-footer clearfix">
		<button class="pull-right btn btn-default" style="margin-top: 44px;"
			type="submit" id="save_button">
			Güncelle <i class="fa fa-arrow-circle-right"></i>
		</button>
	</div>

</div>
<!-- box body  -->