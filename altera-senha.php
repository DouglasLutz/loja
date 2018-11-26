<?php 
    require_once("auto-register.php");
    require_once("conectaBD.php");
    require_once("logica-usuario.php");

    retornaEstranhoParaLogin();

    $email = $_SESSION["usuario_logado"];
    $senha_antiga = $_POST["senha_antiga"];
    $senha_nova = $_POST["senha_nova"];

    $usuarioDao = new UsuarioDao($conexao);
    

    if($usuarioDao->alteraSenhaUsuario($email, $senha_antiga, $senha_nova)){
        $_SESSION["success"] = "Senha alterada com sucesso";
    	header("Location: index.php");
    } else {
        $_SESSION["danger"] = "Antiga senha incorreta, tente novamente!";
        header("Location: formulario-altera-senha.php");
    }