<?php 
include "conecta.php";

if(isset($_POST['cadastra'])){



    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $cidade = $_POST['cidade'];
    $login = $_POST['login'];
    $senha = $_POST['senha'];
    
    //Verificar se usuario já existe VERIFICARRRRR
    $sql1 = "SELECT * FROM usuario";
    $resultado = pg_query($conexao,$sql1);
    $registro = pg_fetch_array($resultado);
    
    if (!empty($_POST) AND (empty($_POST['login']) OR empty($_POST['senha']))) {
        header("Location: index.php"); exit;
    }
    if($registro['login'] == $login){
        echo "
        <script>
        window.location='index.php';
        alert('Nome de login: $login, já existe! ');
        </script>";
    }
        if($registro['email'] == $email){
            echo"
            <script>
            window.location='index.php';
            alert('Email: $email, já existe! );
            </script>";
        }
    else{
            $sql = "INSERT INTO usuario (nome , email, cidade, login, senha) values ('$nome', '$email', '$cidade' , '$login' , '$senha')";
            $resultadox = pg_query($conexao,$sql); 

            if($resultadox)
            {	

                echo "
                <script>
                window.location='index.php';
                alert('$nome, seu cadastro foi realizado com sucesso. Clique para login!');
                </script>";

            }
            else 
            {
                echo "
                <script>
                window.location='index.php';
                alert('Não foi possivel realizar o cadastro!');
                </script>";

            }
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
