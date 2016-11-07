<nav>
	<ul>
		<li><a href="<?=BASE_URL;?>">index</a></li>
		<li><a href="<?=BASE_URL;?>home/acerca">Acerca</a></li>
		<li><a href="<?=BASE_URL;?>home/contacto">Contacto</a></li>
		<li><a href="#" id="menu_ingresar">Ingresar</a>
			<div id="sub_menu_ingresar">
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
				<a class="link" href="<?=htmlspecialchars(BASE_URL);?>cuentas/registro_usuarios">Registrarse</a>
				<a  class="link" href="<?=htmlspecialchars(BASE_URL);?>cuentas/forgotMyPassword">Olvide mi password</a>
				Otras opciones de logueo
				<a href="#" class="btn-facebook">Login con facebook</a><br />
				<a href="#" class="btn-google">Login con google</a>
				<div id="mensaje"></div>
			</form>
		</fieldset>
		</li>
		<?php  if($session->isLoggedIn()){ ?>
		<li><a href="<?=BASE_URL;?>cuentas/usuarios">Usuario</a></li>
		<li><a href="<?=BASE_URL;?>cuentas/logout">Salir</a></li>
		<?php }?>
	</ul>
</nav>