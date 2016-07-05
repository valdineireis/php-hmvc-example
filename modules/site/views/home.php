<h1>Olá <?php echo $name; ?></h1>

<?php if (count($usuarios) > 0): ?>
	<h2>Lista de usuários</h2>
	<ul>
		<?php foreach ($usuarios as $usuario): ?>
			<li><?php echo $usuario->nome ?></li>
		<?php endforeach ?>
	</ul>
<?php endif ?>
