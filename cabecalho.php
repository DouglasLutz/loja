<?php 
error_reporting(E_ALL ^ E_NOTICE);
require_once("mostra-alerta.php"); 
require_once("conectaBD.php");
require_once("logica-usuario.php");

require_once("auto-register.php");

?>
<html>
<head>
    <title>Minha loja</title>
    <meta charset="utf-8">
    <link href="css/reset.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/loja.css" rel="stylesheet" />
</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">

        <!-- div que alinha os itens da navbar à esquerda -->
        <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <?php if(usuarioEhAdmin()) : ?>
                        <li>
                        	<a class="nav-link active" href="produto-controle.php">Controle de produtos</a>
                        </li>
                    <?php endif ?>

                    <li>
                    	<a class="nav-link active" href="produto-lista.php">Lista Produtos</a>
                    </li>
                    <li>
                    	<a class="nav-link active" href="contato.php">Contato</a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- div que alinha os itens da navbar no meio -->
        <div class="mx-auto order-0">
            <ul class="navbar-nav mx-auto">
                <div class="navbar-header">
                    <a href="index.php" class="navbar-brand">Minha Loja</a>
                </div>
            </ul>
        </div>

        <!-- div que alinha os itens da navbar à direita -->
        <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
            <ul class="navbar-nav ml-auto">
                <?php if(usuarioEstaLogado()):?>
                    <li class="nav-item active">
                        <a class="nav-link active" href="carrinho.php">Meu carrinho</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="painel-usuario.php"><?=usuarioLogado()?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="logout.php">Logout</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>



    <div class="container">

        <div class="principal">
            <?php   mostraAlerta("success");
                    mostraAlerta("danger");
            ?>
    <!-- fim cabecalho.php -->