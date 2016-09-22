<fieldset>
	<legend>Registro Usuarios</legend>
	<form>
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
		<input type="mail" /><br />
		<label>Password:</label><br />
		<input type="password" />
		<label>Fecha de Nacimiento:</label><br />
		<input type="date" id="nombre" name="txt_fecha_nac" /><br />
		<label>Introduce el codigo:</label><br />
		<img src="http://127.0.0.1:8080/curriculum/php/captcha.php" /><br />
		<input type="text" /><br />
		<input type="submit" value="Registrarse" />
	</form> 
	<a href="<?=BASE_URL;?>">Ingresar</a>
</fieldset>