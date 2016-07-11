<h1>Página inicial da loja</h1>

<?php if (count($produtos) > 0): ?>

	<h2>Lista de Produtos</h2>
	<?php foreach ($produtos as $produto): ?>
		<div class="box-loja">
			<img alt="<?php echo utf8_encode($produto->nome) ?>" src="" border="0" width="60" />
			<h3><?php echo $produto->nome ?></h3>
			<strong><?php echo 'R$ '.$produto->preco ?></strong>
			<br>
			<a href="/loja/home/ver/<?php echo $produto->id ?>">Visualizar</a>
		</div>
	<?php endforeach; ?>

<?php endif; ?>
