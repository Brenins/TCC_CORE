<?php
    $servidor = "localhost";
    $usuario  = "root";
    $senha    = "";
    $banco    = "vitrine";

    try {
        $pdo = new PDO("mysql:host={$servidor};dbname={$banco};charset=utf8;",$usuario,$senha);
    } catch (Exception $e) {
        echo "<p>Erro ao tentar conectar</p>";
        echo $e->getMessage();
    }

    function formatarValor($valor){
        $valor = str_replace(".","",$valor);
        return str_replace(",",".",$valor);
    }
