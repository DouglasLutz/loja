<?php 
    error_reporting(E_ALL ^ E_NOTICE);
    require_once("logica-usuario.php");
    retornaEstranhoParaLogin();
    
    require_once("cabecalho.php");

    $produtoDao = new ProdutoDao($conexao);
    $categoriaDao = new CategoriaDao($conexao);

    $produto = $produtoDao->buscaProduto($_POST['id']);
    $categorias = $categoriaDao->listaCategorias();

    $usado = $produto->getUsado() ? "checked='checked'" : "";
?>

<h1>Alterando produto</h1>
<form action="altera-produto.php" method="post">
    <input type="hidden" name="id" value="<?=$produto->getId()?>" />
    <table class="table">

        <?php require_once("campos-tabela-formulario.php") ?>
        
        <tr>
            <td><button class="btn btn-primary" type="submit">Alterar</button></td>
        </tr>
    </table>
</form>

<?php require_once("rodape.php"); ?>
