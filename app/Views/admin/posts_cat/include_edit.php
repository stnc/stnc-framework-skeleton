

<div class="box-body">
	<strong><?php echo $language;?> </strong>
	
	 <input type="hidden"name="language[]" value="<?php echo $lng;?>">
	
	<input type="hidden" name="cat_post_id" value="<?php echo $lang[$lng]['cat_post_id_'.$lng]?>">

	<div class="form-group">
		<label for="title">Başlık</label> <input type="text"
			class="form-control" name="cat_title_<?php echo $lng?>"
			id="cat_title_<?php echo $lng?>"
			value="<?php echo $lang[$lng]['cat_title_'.$lng]?>" placeholder="Başlık">
	</div>

	<div class="form-group">
		<label for="cat_slug">Slug</label> <input type="text" class="form-control"
			name="cat_slug_<?php echo $lng?>"
			value="<?php echo $lang[$lng]['cat_slug_'.$lng]?>" readonly="readonly"
			id="cat_slug_<?php echo $lng?>" placeholder="Slug">
	</div>

	

</div>
<!-- box body  -->