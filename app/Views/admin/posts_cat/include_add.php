

<div class="box-body">
	<strong><?php echo $language;?> </strong>
	<input type="hidden" name="language[]" value="<?php echo $lng;?>">



	<div class="form-group">
		<label for="title">Başlık</label> <input type="text"
			class="form-control" name="cat_title_<?php echo $lng?>" id="cat_title_<?php echo $lng?>"
			placeholder="Başlık">
	</div>

	<div class="form-group">
		<label for="slug">Slug</label> <input type="text"
			class="form-control" name="cat_slug_<?php echo $lng?>" readonly="readonly"  id="cat_slug_<?php echo $lng?>"
			placeholder="Slug">
	</div>


</div>
<!-- box body  -->