<h1>Produtos</h1>

<a href="/painel/produtos/add" class="btn btn-default">Adicionar Produto</a>

<table class="table table-striped table-condensed">
	<thead>
		<tr>
			<th>Imagem</th>
			<th>Nome</th>
			<th>Categoria</th>
			<th>Preço</th>
			<th>Quantidade</th>
			<th width="200">Ações</th>
		<tr>
	</thead>
	<tbody>
	<?php foreach ($produtos as $prod): ?>
	<tr>
		<td><img src="<?php echo $prod->imagem; ?>" alt="<?php echo $prod->nome; ?>" border="0" height="80" /></td>
		<td><?php echo $prod->nome; ?></td>
		<td><?php echo $prod->categoria; ?></td>
		<td><?php echo $prod->preco; ?></td>
		<td><?php echo $prod->quantidade; ?></td>
		<td>
			<a href="/painel/produtos/edit/<?php echo $prod->id; ?>" class="btn btn-default">Editar</a>
			<a href="/painel/produtos/remove/<?php echo $prod->id; ?>" class="btn btn-default">Excluir</a>
		</td>
	<tr>
	<?php endforeach; ?>
	</tbody>
</table>

<nav>
	<ul class="pagination">
		<?php
		$conta = ceil($total_produtos / $limit_produtos);
		for ($q = 1; $q <= $conta; $q++): ?>
			<li><a href="/painel/produtos?p=<?php echo $q; ?>"><?php echo $q; ?></a></li>
		<?php endfor; ?>
	</ul>
</nav>
