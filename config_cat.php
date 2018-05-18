
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
                <div id="form_config">
                    <form name="form_serie" action="" method="post" id="form_serie" enctype="multipart/form-data">
                        <br><label> Nome da categoria: <input type="text" id="nome_cat" name="nome_cat"/></label></br>               
                    <input type="reset" name="limpar" id="limpar" value="Limpar"/>
                    <input type="submit" name="enviar" id="enviar" value="Enviar"/>    
                    </form>
                </div>
            </article>
        </section>

    </body>
</html>
<?php 
include "conecta.php";

if(isset($_POST['enviar'])){
    $nome_cat = $_POST['nome_cat'];
    $sql = "INSERT INTO categoria (nome_cat) values ('$nome_cat')";
    $resultado = pg_query($conexao,$sql); 
    if($resultado)
    {	
        echo "<h1> Cadastro Realizado com Sucesso!</h2>";
        echo "<a href='inicio.php'> <h3>Clique para voltar a tela principal</hr></a>";


    }
    else 
    {
        echo "<h1>Falha no Engano!</h1> <br>";
        echo "<a href='config_cat.php'> <h2>Tente Novamente! :D </h2></a>";
    }
}
?>