<h1>Carrinho de Compras</h1>

<?php if(empty($produtos)): ?>
	Carrinho vazio.
<?php else: ?>
	<table border="0" width="100%">
		<tr>
			<th align="left">Imagem</th>
			<th align="left">Nome do Produto</th>
			<th align="left">Valor</th>
			<th align="left">Ações</th>
		</tr>
		<?php $subtotal = 0; ?>
		<?php foreach($produtos as $produto): ?>
		<tr>
			<td><img alt="<?php echo utf8_encode($produto->nome) ?>" src="" border="0" width="60" /></td>
			<td><?php echo utf8_encode($produto->nome) ?></td>
			<td><?php echo 'R$ '.$produto->preco ?></td>
			<td>
			</td>
		</tr>
		<?php $subtotal += $produto->preco; ?>
		<?php endforeach; ?>
		<tr>
			<td colspan="2" align="right">Subtotal:</td>
			<td align="left"><?php echo 'R$ '.$subtotal; ?></td>
			<td></td>
		</tr>
	</table>
<?php endif; ?>
