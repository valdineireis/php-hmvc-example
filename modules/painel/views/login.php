<form class="form-signin" method="post">

	<h2 class="form-signin-heading">Login do Painel</h2>

	<?php if (!empty($aviso)): ?>
		<div class="alert alert-danger" role="alert"><?php echo $aviso; ?></div>
	<?php endif; ?>

	<label for="email" class="sr-only">E-mail</label>
	<input type="email" id="email" name="email" class="form-control" placeholder="E-mail" required autofocus>
	<label for="senha" class="sr-only">Senha</label>
	<input type="password" id="senha" name="senha" class="form-control" placeholder="Senha" required>
	<button class="btn btn-lg btn-primary btn-block" type="submit">Acessar</button>
</form>
