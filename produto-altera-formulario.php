<?php 
    require_once("cabecalho.php");
    require_once("banco-categoria.php");
    require_once("banco-produto.php");
    require_once("logica-usuario.php");

    require_once("class/Produto.php");
    require_once("class/Categoria.php");

    retornaEstranhoParaLogin();

    $id = $_POST['id'];
    $produto = buscaProduto($conexao, $id);

    $categorias = listaCategorias($conexao);

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
