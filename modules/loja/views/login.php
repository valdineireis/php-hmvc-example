<h1>Página de LOGIN</h1>

<?php if (!empty($aviso)): ?>
	<div><?php echo $aviso; ?></div>
<?php endif; ?>

<form method="post">
	E-mail:<br>
	<input type="text" name="email" /><br><br>

	Senha:<br>
	<input type="password" name="senha" /><br><br>

	<input type="submit" value="Logar" />
</form>
