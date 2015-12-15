<div class="box-body">
	<strong>İngilizce </strong>
	<input type="hidden" name="language[]" value="<?php echo $language;?>">


	<div class="form-group">
		<label for="title">Başlık</label> <input type="text"
			class="form-control" name="title_<?php echo $language?>" id="title_<?php echo $language?>"
			placeholder="Başlık">
	</div>


	<div class="form-group">
		<label for="slug">Slug</label>
		
		<input type="text"	class="form-control" name="slug_<?php echo $language?>" value="<?php echo $lang[$language]['slug_'.$language]?>" readonly="readonly" id="slug_<?php echo $language?>"
			placeholder="Slug">
	</div>


</div>
<!-- box body  -->