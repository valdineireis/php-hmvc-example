<h1>Finalizar Compra</h1>

<fieldset>
	<legend>Informações do Usuário</legend>
	Nome: <input type="text" name="usuario_nome" /><br><br>
	Email: <input type="email" name="usuario_email" /><br><br>
	Senha: <input type="password" name="usuario_senha" /><br><br>
</fieldset>
<br><br>
<fieldset>
	<legend>Informações de Endereço</legend>
	País: <input type="text" name="endereco_pais" /><br><br>
	CEP: <input type="text" name="endereco_cep" /><br><br>
	Cidade: <input type="text" name="endereco_cidade" /><br><br>
	Bairro: <input type="text" name="endereco_bairro" /><br><br>
	Logradouro: <input type="text" name="endereco_logradouro" /><br><br>
	Número: <input type="text" name="endereco_numero" /><br><br>
	Complemento: <input type="text" name="endereco_complemento" /><br><br>
</fieldset>
<br><br>
<fieldset>
	<legend>Resumo da Compra</legend>
	Total a pagar: <?php echo 'R$ '.$total; ?>
</fieldset>
<br><br>
<fieldset>
	<legend>Informações de Pagamento</legend>

	<?php foreach ($tipos_pagamentos as $tipo): ?>
		<input type="radio" name="tipo_pg" value="<?php echo $tipo->id; ?>" /> <?php echo $tipo->nome; ?> <br>
	<?php endforeach; ?>
</fieldset>
<br><br>
<input type="submit" value="Efetuar pagamento" />
