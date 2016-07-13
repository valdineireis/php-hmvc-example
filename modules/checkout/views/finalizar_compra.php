<h1>Finalizar Compra</h1>

<?php if (!empty($erro)): ?>
	<div class="msg-erro">
		<?php echo $erro; ?>
	</div>
<?php endif; ?>

<form method="post">
	<fieldset>
		<legend>Informações do Usuário</legend>
		Nome: <input type="text" name="usuario_nome" value="<?php if (isset($form['usuario_nome'])) echo $form['usuario_nome']; ?>" /><br><br>
		Email: <input type="email" name="usuario_email" value="<?php if (isset($form['usuario_email'])) echo $form['usuario_email']; ?>" /><br><br>
		Senha: <input type="password" name="usuario_senha" /><br><br>
	</fieldset>
	<br><br>
	<fieldset>
		<legend>Informações de Endereço</legend>
		CEP: <input type="text" name="endereco_cep" value="<?php if (isset($form['endereco_cep'])) echo $form['endereco_cep']; ?>" /><br><br>
		Estado: <input type="text" name="endereco_uf" value="<?php if (isset($form['endereco_uf'])) echo $form['endereco_uf']; ?>" /><br><br>
		Cidade: <input type="text" name="endereco_cidade" value="<?php if (isset($form['endereco_cidade'])) echo $form['endereco_cidade']; ?>" /><br><br>
		Bairro: <input type="text" name="endereco_bairro" value="<?php if (isset($form['endereco_bairro'])) echo $form['endereco_bairro']; ?>" /><br><br>
		Logradouro: <input type="text" name="endereco_logradouro" value="<?php if (isset($form['endereco_logradouro'])) echo $form['endereco_logradouro']; ?>" /><br><br>
		Número: <input type="text" name="endereco_numero" value="<?php if (isset($form['endereco_numero'])) echo $form['endereco_numero']; ?>" /><br><br>
		Complemento: <input type="text" name="endereco_complemento" value="<?php if (isset($form['endereco_complemento'])) echo $form['endereco_complemento']; ?>" /><br><br>
	</fieldset>
	<br><br>
	<fieldset>
		<legend>Resumo da Compra</legend>
		Total a pagar: <?php echo 'R$ '.$total; ?>
	</fieldset>
	<br><br>
	<fieldset>
		<legend>Informações de Pagamento </legend>

		<?php foreach ($tipos_pagamentos as $tipo): ?>
			<input type="radio" name="tipo_pg" 
				value="<?php echo $tipo->id; ?>" 
				<?php if (isset($form['tipo_pg'])) echo $form['tipo_pg'] == $tipo->id ? 'checked=checked' : '' ?>
			/> 
			<?php echo $tipo->nome; ?> <br>
		<?php endforeach; ?>
	</fieldset>
	<br><br>
	<input type="submit" value="Efetuar pagamento" />
</form>
