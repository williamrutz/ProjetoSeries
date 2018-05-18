
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
        
        <script type="text/javascript">

            $(document).ready(function() {	

                $('a[name=modal]').click(function(e) {
                    e.preventDefault();

                    var id = $(this).attr('href');

                    var maskHeight = $(document).height();
                    var maskWidth = $(window).width();

                    $('#mask').css({'width':maskWidth,'height':maskHeight});

                    $('#mask').fadeIn(1000);	
                    $('#mask').fadeTo("slow",0.9);	

                    //Get the window height and width
                    var winH = $(window).height();
                    var winW = $(window).width();

                    $(id).css('top',  winH/4-$(id).height()/1);
                    $(id).css('left', winW/2-$(id).width()/2);

                    $(id).fadeIn(2000); 

                });

                $('.window .close').click(function (e) {
                    e.preventDefault();

                    $('#mask').hide();
                    $('.window').hide();
                });		

                $('#mask').click(function () {
                    $(this).hide();
                    $('.window').hide();
                });			

            });

        </script>
    </head>


    <body>
        <div id="topo">
            <?php
            include "topo.php";
            ?>
        </div>
        <section>
            <article>
                <div class="dest2cat">
                    <?php
                    include "conecta.php";
                    $id_cat=$_GET['id_cat'];
                    $sql = "SELECT * FROM categoria WHERE id_cat = '$id_cat'";
                    $resultado = pg_query($conexao, $sql);
                    $linhas = pg_num_rows($resultado);
                    $x = pg_fetch_array($resultado);
                    $nome_cat = $x['nome_cat'];
                    echo "<h2 class='navbar navbar-default' align='center'>".$nome_cat."</h2>";
                    ?>
            
                        <?php
                        include "conecta.php";
                        $sql = "SELECT * FROM series, categoria WHERE series.id_cat = categoria.id_cat AND series.id_cat = '$id_cat'";
                        $resultado = pg_query($conexao, $sql);
                        $linhas = pg_num_rows($resultado);
                        for ($i=0; $i<$linhas; $i++)
                        {
                            $x = pg_fetch_array($resultado);
                            $id_serie2 = $x['id_serie'];
                            $nome2 = $x['nome'];
                            $banner2 = $x['banner'];
                        ?> 
                        <div class="div2_cat">
                            <?php
                            echo "<p class='panel-title' align='center'><b>".$nome2."<b></p>"
                            ?>
                            <div class="div3" align="center">
                                <?php
                                echo "<a id='link_serie'  href='serie.php?id_serie=".$id_serie2."'><img class='norms' widht='150px'height='200px' src='imagens/".$banner2."'></a>";
                                ?>
                            </div>
                        </div>
                        <?php
                        }
                        ?>


                    </div>
                
 

                    </article>
                </section>

            </body>
        </html>