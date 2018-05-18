<?php
include "conecta.php";
$id_serie = $_GET['id_serie'];
$sql = "SELECT * FROM series WHERE id_serie = '$id_serie'";
$resultado = pg_query($conexao, $sql);
$x = pg_fetch_array($resultado);
$nome = $x['nome'];
$sinopse = $x['sinopse'];
$banner = $x['banner'];
$title = $x['title'];
$id = $x['id'];
?>

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

        <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet">
        <link href="rate/css/star-rating.css" media="all" rel="stylesheet" type="text/css" />

        <!-- optionally if you need to use a theme, then include the theme file as mentioned below -->
        <link href="rate/themes/krajee-svg/theme.css" media="all" rel="stylesheet" type="text/css" />

        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.js"></script>
        <script src="rate/js/star-rating.js" type="text/javascript"></script>

        <!-- optionally if you need to use a theme, then include the theme file as mentioned below -->
        <script src="rate/themes/krajee-svg/theme.js"></script>

        <!-- optionally if you need translation for your language then include locale file as mentioned below -->
        <script src="rate/js/locales/{lang}.js"></script>

    </head>

    <body>
        <div id="topo">
            <?php
            include "topo.php";
            ?>
        </div>
        <section>
            <article>
                <div class="dest">
                    <?php
                    echo "<h2 class='navbar navbar-default' align='center'>".$nome."</h2>";
                    ?>

                    <div class="div1">
                        <div class="div11" align="center">
                            <?php
                            echo "<img class='banner' src='imagens/".$banner."'>";
                            ?>
                        </div>
                    </div>

                    <div class="div3">
                        <div id="sinopse"><h4>Sinopse:</h4></div>
                        <div id="text_sinopse">
                            <?php
                            echo "".$sinopse."";

                            ?>
                        </div>
                    </div>
                    <div class="div4">
                        <div id="trailer"> <h4>Assista ao Trailer:</h4>
                            <div id="box_trailer">
                                <?php
                                echo "<a target='_blank' title='".$title."' href='http://www.youtube.com/embed/".$id."?rel=0&amp;wmode=transparent'>
                                    <img src='http://i1.ytimg.com/vi/".$id."/default.jpg' width='180px' height='120px' alt='".$title."' />
                                </a>"
                                ?>
                            </div>
                        </div>

                    </div>
                        <form method='post' action='rateia.php' id="rateia" name="rateia" >
                        <?php
                        $sql = "SELECT * FROM avaliacao";
                        $resultado = pg_query($conexao, $sql);
                        $registro = pg_fetch_array($resultado);
                        ?>
                        <input id='input-1' name='input-1' class='rating rating-loading' data-min='0' data-max='5' data-step='1' value='<?= $registro['nota'] ?>'>
                        <input type='hidden' name='id_serie' value='<?= $id_serie ?>' />
                        <input type='submit' class='btn btn-primary' value='Avaliar' />

                        </form>
                    

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