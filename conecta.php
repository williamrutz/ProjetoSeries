<?php
 $servidor = "localhost";
 $porta = 5432;
 $bd = "postgres";
 $usuario = "postgres";
 $senha = "senha5";
 $conexao = pg_connect("host=$servidor port=$porta dbname=$bd user=$usuario password=$senha");
 if(!$conexao) {
 die("Não foi possível se conectar ao banco de dados.");
 }
?>
