<?php 
include "conecta.php";

if(isset($_POST['logar'])){
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuario WHERE login = '$login' and senha = '$senha'";
    $resultado = pg_query($conexao,$sql);
    $registro = pg_fetch_array($resultado);
    

    if($registro['nivel'] == 1)
    {
        session_start();
        $_SESSION['id_user'] = $registro['id_user'];
        header("location:index.php");
    }
    else if($registro['nivel'] == 2){
        session_start();
        $_SESSION['id_user'] = $registro['id_user'];
        header("location:index.php");
    }else
    {
        echo "<h2> > Deu Ruim, Tente Novamente!!</h2>";
        echo "<a href='index.php'/> <h3> Faça o Login Novamente </h3> </a>";
    }


}
?>
<!DOCTYPE HTML>
<html>
    <head>

        <meta charset="UTF-8"/>

    </head>

    <body>
    </body>

</html>