<fieldset>
	<legend>Registro Usuarios</legend>
	<form action="<?=BASE_URL;?>cuentas/registrar" method="post">
		<label>Nombre:</label><br />
		<input type="text" id="nombre" name="txt_nombre" /><br />
		<label>Apellido:</label><br />
		<input type="text" id="nombre" name="txt_apellido" /><br />
		<label>sexo:</label><br />
		<select name="slp_sexo">
			<option value="0">Selecciona una opción</option>
			<option value="h">Masculino</option>
			<option value="m">Femenino</option>
		</select>
		<br />
		<label>Correo:</label><br />
		<input type="mail" name="txt_correo" /><br />
		<label>Password:</label><br />
		<input type="password" name="txt_pw" />
		<label>Fecha de Nacimiento:</label><br />
		<input type="date" id="nombre" name="txt_fecha_nac" /><br />
		<label>Introduce el codigo:</label><br />
		<img src="<?=BASE_URL;?>cuentas/cargarCaptcha" /><br />
		<input type="text" id="captcha" name="txt_captcha" /><br />
		<input type="submit" value="Registrarse" />
	</form> 
	<a href="<?=BASE_URL;?>">Ingresar</a><br />
	<a href="<?=BASE_URL;?>cuentas/forgotMyPassword">Olvide mi password</a>
</fieldset>