<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Titulo</title>
		<link type="text/css" rel="stylesheet" href="/templates/default/assets/css/style.css" media="all" />
	</head>
	<body>
		<a href="/">Página inicial</a> | <a href="/loja">Loja</a> | <a href="/checkout">Carrinho</a>
		<hr>
		<?php $this->loadViewInTemplate($viewName, $viewData); ?>
	</body>
</html>
