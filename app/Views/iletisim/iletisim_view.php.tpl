
<div class="container">
	<div class="row">
		<div id="alici_adresleri_secimi">
			<div
				class="col2-layout  col-xs-12 col-sm-12 col-md-12 col-lg-12 pull-left">

				<div class="panel-body">
					<div class="row">
						<div
							class="col2-layout  col-xs-6 col-sm-6 col-md-6 col-lg-6 pull-left">
							<div class="panel panel-info">
								<div class="panel-heading">Bize Ulaşın</div>
								<div class="panel-body">
								
									<?php
        
        echo \Lib\Session::pull('message');
        
        echo \Lib\Error::display($error);
        ?>
    
									<div class="alert alert-danger" style="display: none"
										id="uyarici_alici_hata"></div>
									<div class="alert alert-success" style="display: none"
										id="uyarici_alici_ok"></div>
									<p class="help-block"><?php echo $lng_uyari?></p>

									<form id="kapida_kredi_karti_ile_odeme_formu" method="post"
										action="/iletisim/?action=gonder" role="form">

										<div class="form-group">
											<label for="" class="control-label">{$data.lng_ad_soyad}</label> <input
												type="text" class="form-control" id="ad_soyad"
												value="{$data.send}" name="ad_soyad" />
										</div>


										<div class="form-group">
											<label for="" class="control-label">E-Posta </label> <input
												type="text" class="form-control" id="email"
												value="{$data.email}" name="email" />
										</div>


										<div class="form-group">
											<label for="" class="control-label">Telefon </label> <input
												type="text" class="form-control" id="phone"
												value="{$data.phone}" name="phone" />
										</div>

										<div class="form-group">
											<label for="" class="control-label">Mesajınız </label>
											<textarea style="height: 100px;" name="message" id="message"
												class="form-control  " maxlength="160"> {$data.message} </textarea>
										</div>



										<div class="form-group pull-right">
											<button type="submit" class="kaydet_button btn  btn-primary ">Gönder</button>
										</div>


									</form>
								</div>
							</div>
							<!-- panel info sonu  -->
						</div>
						<!-- col sonu  -->



						<div
							class="col2-layout  col-xs-6 col-sm-6 col-md-6 col-lg-6 pull-left">
							<div class="panel panel-info">
								<div class="panel-heading">adres bilgileri yazılacak</div>
								<div class="panel-body">sdfsdfdsf
								fsdfdsfdsf
								</div>
							</div>
							<!-- panel info sonu  -->
						</div>
						<!-- col sonu  -->

					</div>










				</div>
			</div>
		</div>
	</div>
</div>
