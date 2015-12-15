

<div class="box-body">

	<div class="form-group">
		<label>Kategori</label> <select name="cat_id" class="form-control">
		 <?php
foreach ($categories as $val) {
    echo '<option value="' . $val['cat_id'] . '">' . $val['cat_title'] . '</option>';
}
?>
						</select>
	</div>


	<div class="form-group">
		<label for="title">Başlık</label> <input type="text"
			class="form-control" name="title" id="title" placeholder="Başlık">
	</div>

	<div class="form-group">
		<label for="slug">Slug</label> <input type="text" class="form-control"
			name="slug" readonly="readonly" id="slug" placeholder="Slug">
	</div>

	<div class="form-group">
		<label for="description">Açıklama</label> <input type="text"
			class="form-control" name="description" id="description"
			placeholder="Açıklama">
	</div>


	<div class="form-group">
		<label for="icerik">İçerik</label>
		<textarea class="form-control textarea"
			style="height: 310px; width: 1238px;" id="content" name="content"
			rows="10" cols="80"> </textarea>
	</div>


	<div class="box-footer clearfix">
		<button class="pull-left btn btn-default" onclick="ekle()"
			type="button" id="save_button">RESİM EKLE</button>
	</div>


	<div id="upload" class="box-footer clearfix">
		<input type="file" class="textbox-value"
			class="btn btn-default btn-file" name="uploadPic[]"></br>
	</div>

</div>
<!-- box body  -->