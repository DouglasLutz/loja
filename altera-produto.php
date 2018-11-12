<?php 
    require_once("cabecalho.php");
    require_once("logica-usuario.php");

    retornaEstranhoParaLogin();

    $produto = new Produto($_POST["nome"], $_POST["preco"], $_POST["descricao"]);
    $produto->setId($_POST["id"]);
    $produto->categoria->setId($_POST["categoria_id"]);

    if(array_key_exists('usado', $_POST)){
        $produto->setUsado(1);
    } else {
        $produto->setUsado(0);
    }

    $produtoDao = new ProdutoDao($conexao);

    if($produtoDao->alteraProduto($produto)) { 
        $_SESSION['']
        header("Location: index.php");
    } else {
        header("Location: index.php");
    }
  
require_once("rodape.php"); ?>
