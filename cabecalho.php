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
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/loja.css" rel="stylesheet" />
</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a href="index.php" class="navbar-brand">Minha Loja</a>
            </div>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    
                    <?php if(usuarioEstaLogado()) : ?>
                        <li>
                        	<a class="nav-link active" href="produto-formulario.php">Adiciona Produto</a>
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
    </nav>



    <div class="container">

        <div class="principal">
            <?php   mostraAlerta("success");
                    mostraAlerta("danger");
            ?>
    <!-- fim cabecalho.php -->