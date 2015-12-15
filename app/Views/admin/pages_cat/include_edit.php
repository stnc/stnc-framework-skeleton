<div class="box-body">
	<strong>Türkçe </strong>
	<input type="hidden" name="language[]" value="<?php echo $language;?>">

     <input type="hidden"  name="post_id"	value="<?php echo $lang[$language]['post_id_'.$language]?>">

	<div class="form-group">
		<label for="title">Başlık</label> <input type="text"
			class="form-control" name="title_<?php echo $language?>" id="title_<?php echo $language?>" value="<?php echo $lang[$language]['title_'.$language]?>"
			placeholder="Başlık">
	</div>








</div>
<!-- box body  -->