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
	<form action="<?=BASE_URL;?>cuentas/login" method="post">
		<label for="correo">Correo:</label><br />
		<input type="mail" id="correo" name="txt_correo" /><br />
		<label for="pw">Password:</label>
		<input type="password" id="pw" name="txt_pw" /><br />
		<input type="submit" value="Ingresar" /><br />
		<a href="<?=BASE_URL;?>cuentas/registro_usuarios">Registrarse</a><br />
		<a href="<?=BASE_URL;?>cuentas/forgotMyPassword">Olvide mi password</a>
	</form>
</fieldset>