<h1>Hola desde controllador Home</h1>
<?=$_SERVER["HTTP_USER_AGENT"]."<br />";?>
<?="session navegador: ".$_COOKIE["PHPSESSID"]."<br />"."session_base: 7btopareainlivu6a676ftjob3";?>
<fieldset>
<?php
if($logueado)
{
	echo "estas logueado";
}
else
{
	echo "No estas logueado";
}
?>
	<legend>Ingresar</legend>
	<form action="<?=htmlentities(BASE_URL);?>cuentas/login" method="post">
		<label for="correo">Correo:</label><br />
		<input type="mail" id="correo" name="txt_correo" placeholder="introduce tu correo" /><br />
		<label for="pw">Password:</label>
		<input type="password" id="pw" name="txt_pw" placeholder="introduce tu password" /><br />
		<?php 
			if($session->intentos >= 5) 
			{
				echo "<label>Ingresa el codigo:</label><br />";
				echo "<img src='".BASE_URL."cuentas/cargarCaptcha' name='captcha' /><br />";
				echo "<input type='text' name='txt_captcha' /><br />";
			}
		?>
		<input type="submit" id="btn_ingresar" value="Ingresar" /><br />
		<a href="<?=htmlspecialchars(BASE_URL);?>cuentas/registro_usuarios">Registrarse</a><br />
		<a href="<?=htmlspecialchars(BASE_URL);?>cuentas/forgotMyPassword">Olvide mi password</a>
		<div id="mensaje"></div>
	</form>
</fieldset>