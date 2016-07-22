<?php
global $config;
?>
<h1>Meus Pedidos</h1>

<a href="/loja/login/logout">Sair</a>

<table border=1>
	<tr>
		<th>Nº do Pedido</th>
		<th>Valor Pago</th>
		<th>Forma de Pgto</th>
		<th>Status do Pgto</th>
		<th>Ações</th>
	</tr>
	<?php foreach ($pedidos as $pedido): ?>
	<tr>
		<td><?php echo $pedido->id; ?></td>
		<td>R$ <?php echo $pedido->valor; ?></td>
		<td><?php echo $pedido->tipopgto; ?></td>
		<td><?php echo $config['status_pagamento'][$pedido->status_pagamento]; ?></td>
		<td><a href="/loja/pedidos/ver/<?php echo $pedido->id; ?>">Detalhes</a></td>
	</tr>
	<?php endforeach; ?>
</table>


