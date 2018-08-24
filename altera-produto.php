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
        ?> <p class="text-success">O produto <?= $produto->getNome(); ?>, <?= $preco; ?> alterado com sucesso!</p><?php 
    } else {
        $msg = mysqli_error($conexao);
        ?> <p class="text-danger">O produto <?= $produto->nome; ?> não foi alterado: <?= $msg ?></p><?php
    }
  
require_once("rodape.php"); ?>
