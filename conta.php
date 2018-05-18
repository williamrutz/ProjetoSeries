
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="bt/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="estilo.css">
        <link rel="stylesheet" type="text/css" href="estilo_form.css">
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.1/jquery.min.js"></script> 
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>  

    </head>


    <body>
        <div id="topo">
            <?php
            include "topo.php";
            ?>
        </div>
        <section>
            <article>
                <?php
                include "conecta.php";
                if(isset($_SESSION['id_user']))
                {
                    $id_user = $_SESSION['id_user'];

                    $sql = "SELECT * FROM usuario WHERE id_user = '$id_user'";
                    $resultado = pg_query($conexao, $sql);
                    $registros = pg_fetch_array($resultado);

                    echo "<form class='conta' name='conta' method='post' action=''>";
                    echo "<h1 id='text_cadastro'>Edite seu cadastro</h1>";
                    echo "<label>Nome: <br><input class='campo' type='text'  id='nome' name='nome' value='".$registros['nome']."' autofocus></label>";
                    echo "<label>Email: <br><input class='campo' type='text'  id='email' name='email' value='".$registros['email']."' ></label>";
                    echo "<label>Login: <br><input class='campo' type='text'  id='login' name='login' value='".$registros['login']."' ></label>";
                    echo "<label>Cidade: <br><input class='campo' type='text'  id='cidade' name='cidade' value='".$registros['cidade']."'></label>";
                    echo "<input type='hidden' id='id_user' name='id_user' value='".$registros['id_user']."'/>";
                    echo "<br>";
                    echo "<input type='submit' name='atualizar' value='Atualizar' />";

                }else{
                    echo "
                    <script>
                    window.location='index.php';
                    alert('Acesso somente para Usuarios Cadastrados!');
                    </script>";

                }if(isset ($_POST['atualizar']))
                {
                    $nome = $_POST['nome'];
                    $email = $_POST['email'];
                    $login = $_POST['login'];
                    $cidade = $_POST['cidade'];
                    $id_user = $_POST['id_user'];

                    $sql = "UPDATE usuario SET nome = '$nome' , email = '$email' , login = '$login' , cidade = '$cidade' WHERE id_user = '$id_user'";
                    $resultado = pg_query($conexao , $sql);

                    if($resultado)
                    {
                        echo "
                        <script>
                        window.location='index.php';
                        alert('$nome, seu cadastro foi atualizado com sucesso. Volte as Series!');
                        </script>";
                    }
                    else
                    {
                        echo "
                        <script>
                        window.location='conta.php';
                        alert('Não foi possivel realizar o cadastro! Tente Novamente!');
                        </script>";
                    }

                }

                ?>
            </article>
        </section>

    </body>
</html>
<?php
include "conecta.php";
if(isset($_SESSION['id_user']))
{

?>

<?php
}else{
    echo "
        <script>
        window.location='index.php';
        alert('Acesso somente para Usuarios Cadastrados!');
        </script>";

} 
?>
