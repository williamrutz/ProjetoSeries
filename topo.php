<?php
include "conecta.php";
ob_start();
session_start();
?>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="bt/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="estilo.css">

    </head>


    <body>

        <header>
            <nav class="navs navbar-brand">
                <a href="index.php"><img class="logo navbar-header" src="wf.png"></a>


                <form  method="get" id="campob" name="campob" class="" action="busca.php">
                    <input type="text" class="busca btn" name="busca" id="busca"> <input type="submit" id="bbusca" class="bbusca btn" value="Buscar"></form>


                <div class="clics dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Categorias
                        <span class="caret"></span></button>
                    <ul class="ul1 dropdown-menu">
                        <?php
                        include "conecta.php";
                        $sql = "SELECT * FROM categoria ORDER BY nome_cat ASC";
                        $resultado = pg_query($conexao, $sql);
                        $linhas = pg_num_rows($resultado);
                        for($i=0; $i<$linhas; $i++){
                            $registro = pg_fetch_array($resultado);
                            $id_cat = $registro['id_cat'];
                            $nome_cat = $registro['nome_cat'];
                            echo "<li><a href='categoria.php?id_cat=".$id_cat."'>".$nome_cat."</a></li>";
                        }
                        ?>
                    </ul>
                </div>


                <div class="clics dropdown">
                    <button class="clics btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                        <?php
                        if(isset($_SESSION['id_user']))
                        {
                            $id_user = $_SESSION['id_user'];
                            $sql = "SELECT * FROM usuario WHERE id_user = '$id_user'";
                            $resultado = pg_query($conexao, $sql);
                            $x = pg_fetch_array($resultado);
                            $nome_user = $x['nome'];
                            $nivel = $x['nivel'];
                            
                            echo $nome_user;
                            echo"<span class='caret'></span></button>
                            <ul style='min-width:100px;'class='dropdown-menu'>
                            <li><a style='margin:0;' class='clics' href='conta.php' >Minha Conta</a></li>";
                                                
                            if($nivel == 2){
                            echo "<li><a style='margin:0;' class='clics' href='config.php' >Configurações</a></li>";
                            }
                                                        
                            echo "<li><a style='margin:0;' class='clics' href='logout.php' >Sair</a></li>
                            </ul>";
                        }else{
                            echo"<a class='clics' href='#dialog' name='modal'>Entrar</a>";
                        }
                        ?>

                        </div>

                    </nav>

                </header>

            </body>
        </html>
