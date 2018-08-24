<?php
spl_autoload_register(function ($nomeDaClasse){
    require_once("class/" . $nomeDaClasse . ".php");
});