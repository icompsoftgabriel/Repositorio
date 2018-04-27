<?php 
require_once("cabecalho.php");
require_once("banco-produto.php");
require_once("logica-usuario.php");
require_once("class/Produto.php");
require_once("class/Categoria.php");

verificaUsuario();

$categoria = new Categoria();
$categoria->setId($_POST['categoria_id']);

$produto = new Produto();
$produto->setNome($_POST['nome']);
$produto->setPreco($_POST['preco']);
$produto->setDescricao($_POST['descricao']);

if(array_key_exists('usado', $_POST)) {
	$produto->setUsado("true");
} else {
	$produto->setUsado("false");
}

$produto->setCategoria($categoria);

if(insereProduto($conexao, $produto)) { ?>
	<p class="text-success">O produto <?= $produto->getNome() ?>, <?= $produto->getPreco() ?> foi adicionado.</p>
<?php 
} else {
	$msg = mysqli_error($conexao);
?>
	<p class="text-danger">O produto <?= $produto->getNome() ?> não foi adicionado: <?= $msg?></p>
<?php
}
?>

<?php include("rodape.php"); ?>