
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
            
        function enviarcadastro(){

            if(document.cadastro.nome.value=="" )
            {
            alert( "Preencha campo NOME corretamente!" );
            document.cadastro.nome.focus();
            return false;
            }
            
            if( document.cadastro.email.value=="" || document.cadastro.email.value.indexOf('@')==-1 || document.cadastro.email.value.indexOf('.')==-1 )
            {
            alert( "Preencha campo E-MAIL corretamente!" );
            document.cadastro.email.focus();
            return false;
            }
            
            if (document.cadastro.cidade.value=="")
            {
            alert( "Preencha o campo CIDADE!" );
            document.cadastro.cidade.focus();
            return false;
            }
            
            if (document.cadastro.login.value=="")
            {
            alert( "Preencha o campo LOGIN!" );
            document.cadastro.login.focus();
            return false;
            }
            
            if (document.cadastro.senha.value=="")
            {
            alert( "Preencha o campo SENHA!" );
            document.cadastro.senha.focus();
            return false;
            }
            
            return true;
            }
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
                <div class="dest">
                    <h2 class="navbar navbar-default" align="center">Lançamentos</h2>
                    <?php
                    include "conecta.php";
                    $sql = "SELECT * FROM series ORDER BY RANDOM() LIMIT 3";
                    $resultado = pg_query($conexao, $sql);
                    $linhas = pg_num_rows($resultado);
                    for ($i=0; $i<=2; $i++)
                    {
                        $x = pg_fetch_array($resultado);
                        $id_serie = $x['id_serie'];
                        $nome = $x['nome'];
                        $banner = $x['banner'];
                    ?>  
                    <div class="div1">
                        <?php
                        echo "<h3 class='panel-title' align='center'><b>".$nome."<b></h3>";
                        ?>
                        <div class="div11" align="center">
                            <?php
                        echo "<a id='link_serie'  href='serie.php?id_serie=".$id_serie."'><img class='' widht='270px' height='398px'  src='imagens/".$banner."'></a>";
                            ?>
                        </div>

                    </div>
                    <?php
                    }
                    ?>
                </div>
                <div class="dest2">
                    <h2 class="navbar navbar-default" align="center">Destaques</h2>
                    <?php
                    include "conecta.php";
                    $sql = "SELECT * FROM series ";
                    $resultado = pg_query($conexao, $sql);
                    $linhas = pg_num_rows($resultado);
                    for ($i=0; $i<$linhas; $i++)
                    {
                        $x = pg_fetch_array($resultado);
                        $id_serie2 = $x['id_serie'];
                        $nome2 = $x['nome'];
                        $banner2 = $x['banner'];
                    ?> 
                    <div class="div2">
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


        <div id="boxes">

            <div id="dialog" class="window">

                <input class="close" type="image" alt="Fechar" title="Fechar" src="fechar.png"/><br />
                <form class="login" id="form_login" method="post" action="valida_login.php">
                    <h1 id="text_login"> Ja é cadastrado?<br> Faça seu Login!!</br></h1>
                <br><label>Login: <br><input class="campo" type="text" id="login" name="login" placeholder=" Digite seu login!" required/></label></br>
            <br><label>Senha: <br><input class="campo" type="password" id="senha" name="senha" placeholder=" Digite sua senha!" required/></label></br>
        <br><label><input class="campo" name="logar" id="logar" type="submit" value="Logar"></label></br>
    </form> 

<div class="linha">
    <table border=0 align=left width=4 height=300 >
        <tr><td bgcolor=white></td></tr>
    </table>
</div>    


<form class="cad" name='cadastro' method="post" action="valida_cad.php" onSubmit="return enviarcadastro();">  
    <h1 id="text_cadastro">Faça Seu Cadastro! </h1>
    <label>Nome: <br><input class="campo" type="text"  id="nome" name="nome" placeholder=" Digite seu nome!" required autofocus></label>
    <br><label>Email: <br><input class="campo" type="email" id="email" name="email"  placeholder=" Digite seu email!" required/></label></br>
    <br><label>Cidade: <br><input class="campo" type="text" id="cidade" name="cidade"  placeholder="Digite o nome da sua cidade!" required/></label></br>
    <br><label>Login:<br> <input class="campo" type="text" id="login" name="login"  placeholder=" Digite um login!" required></label></br>
    <br><label>Senha:<br> <input class="campo" type="password" id="senha" name="senha"  placeholder=" Digite sua senha!" required/></label></br>
    <br><label><input class="campo" name="cadastra" id="cadastra" type="submit" value="Crie sua conta!"/></label></br>
</form>

</div>

<!-- Fim Janela Modal com caixa de diálogo -->  

</div>


<!-- Máscara para cobrir a tela -->
<div id="mask"></div>

</div>



</body>
</html>
