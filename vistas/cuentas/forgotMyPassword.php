<fieldset>
<legend>Reestablecer Password</legend>
<form action="<?=BASE_URL;?>cuentas/reestablecer" method="post">
	<label>Introduce tu E-mail:</label>
	<input type="mail" name="txt_correo" /><br />
	<label>Introduce el codigo:</label><br />
	<img id="captcha" src="<?=BASE_URL;?>cuentas/cargarCaptcha" /><br />
	<input type="text" name="txt_captcha" />
	<br />
	<!--<input type="submit" value="reestablecer" />-->
	<input type="submit" onclick="restablecer()" value="reestablecer" />
</form>
<img id="loader" src='<?=BASE_URL;?>temas/img/ajax-loader.gif' />
<div id="respuesta"></div>
<a href="<?=BASE_URL;?>">Ingresar</a><br />
<a href="<?=BASE_URL;?>cuentas/registro_usuarios">Registarse</a>
</fieldset>