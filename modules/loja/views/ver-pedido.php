<?php
global $config;
?>
<h1>Meu Pedido</h1>

<table border=1>
	<tr>
		<th>Nº do Pedido</th>
		<th>Valor Pago</th>
		<th>Forma de Pgto</th>
		<th>Status do Pgto</th>
	</tr>
	<tr>
		<td><?php echo $pedido->id; ?></td>
		<td>R$ <?php echo $pedido->valor; ?></td>
		<td><?php echo $pedido->tipopgto; ?></td>
		<td><?php echo $config['status_pagamento'][$pedido->status_pagamento]; ?></td>
	</tr>
</table>

<hr/>

<?php foreach ($produtos as $produto): ?>
	<div class="box-loja">
		<img src="" alt="<?php echo utf8_encode($produto->nome) ?>" /><br>
		<?php echo utf8_encode($produto->nome) ?><br>
		<?php echo 'R$ '.$produto->preco ?><br>
		<?php echo $produto->quantidade ?>
	</div>
<?php endforeach; ?>
