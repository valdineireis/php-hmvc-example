<h1>Categorias</h1>

<a href="/painel/categorias/add" class="btn btn-default">Adicionar Categoria</a>

<table class="table table-striped table-condensed">
	<thead>
		<tr>
			<th>Título</th>
			<th width="200">Ações</th>
		<tr>
	</thead>
	<tbody>
	<?php foreach ($categorias as $cat): ?>
	<tr>
		<td><?php echo $cat->nome; ?></td>
		<td>
			<a href="/painel/categorias/edit/<?php echo $cat->id; ?>" class="btn btn-default">Editar</a>
			<a href="/painel/categorias/remove/<?php echo $cat->id; ?>" class="btn btn-default">Excluir</a>
		</td>
	<tr>
	<?php endforeach; ?>
	</tbody>
</table>
