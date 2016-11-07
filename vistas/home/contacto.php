<h2>Contactanos</h2>
<p>
<b>tel:</b>4588554
</p>
<fieldset>
	<legend>Contactanos</legend>
	<form action="" method="post">
		<input type="hidden" name="csrf" value="sdsdsa45das45d5s4da5ds5sd54sa" />
		<label>Nombre:</label>
		<input type="text" name="txt_nombre" /><br />
		<label>Correo:</label>
		<input type="text" name="txt_correo" /><br />
		<label>Comentario:</label><br />
		<textarea name="txt_comentario"></textarea><br />
		<label>Introduce el codigo:</label><br />
		<!--<img src="<?=BASE_URL?>/cuentas/cargarCaptcha"><br />-->
		<img src="<?=BASE_URL?>captcha"><br />
		<input type="text" name="txt_captcha" /><br />
		<input type="submit" value="Enviar" />
	</form>
</fieldset>