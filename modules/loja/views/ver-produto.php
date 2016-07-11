<img alt="<?php echo utf8_encode($produto->nome) ?>" src="" border="0" width="150" class="pull-left" />
<h1><?php echo $produto->nome ?></h1>
<?php echo $produto->descricao ?>
<br>
<strong><?php echo 'R$ '.$produto->preco ?></strong>
<br><br>
<a href="/checkout/home/add/<?php echo $produto->id ?>">Adicionar ao Carrinho</a>
