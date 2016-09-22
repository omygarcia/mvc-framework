<nav>
	<ul>
		<li><a href="<?=BASE_URL;?>">index</a></li>
		<?php  if($session->isLoggedIn()){ ?>
		<li><a href="<?=BASE_URL;?>cuentas/usuarios">Usuario</a></li>
		<li><a href="<?=BASE_URL;?>cuentas/logout">Salir</a></li>
		<?php }?>
	</ul>
</nav>