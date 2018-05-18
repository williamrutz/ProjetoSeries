<?php 
include "conecta.php";

if(isset($_POST['enviar_serie'])){
    $post = $_POST;
    $nome_arq = $_FILES['banner']['name'];
    $tamanho_arq = $_FILES['banner']['size'];
    $arq_temp = $_FILES['banner']['tmp_name'];



    if(!empty($nome_arq))
    {
        include "config_upload.php";
        if($sobrescrever == "nao" && file_exists("$caminho/$nome_arq"))
        {
            die ("Arquivo ja existe");
        }
        if($limitar_tamanho == "sim" && ($tamanho_arq > $tamanho_bytes))
        {
            die ("Arquivo deve ter no maximo".$tamanho_arq." bytes");
        }

        $ext = strrchr($nome_arq, '.');

        if(($limitar_ext == "sim") && !in_array($ext,$extensoes_validas))
        {
            die ("Extensao invalida!");
        }

        if(move_uploaded_file($arq_temp, "imagens/$nome_arq"))
        {
            echo "Upload do arquivo:".$nome_arq." concluido com sucesso! ";
        }else
        {
            die ("Falha no envio do arquivo!");
        }
    }else
    {
        die ("Selecione o arquivo a ser enviado!");
    }
    
    if(isset($post['title']) && $post['title'] && strlen($post['title']) >= 5 && isset($post['url']) && $post['url']){
        $title = $_POST['title'];
        $subString = parse_url($post['url']);
        if(isset($subString['query']) && $subString['query']){
            parse_str($subString['query'], $output);
            if(isset($output['v']) && $output['v']){
                

                $nome = $_POST['nome'];
                $sinopse = $_POST['sinopse_add'];
                $banner = $_FILES['banner']['name'];
                $id = $output['v'];
                $id_cat = $_POST['categoria'];
                $sql = "INSERT INTO series (nome , sinopse, banner, title, id, id_cat) values ('$nome', '$sinopse', '$banner' , '$title' , '$id' , '$id_cat')";
                $resultado = pg_query($conexao,$sql); 
                if($resultado)
                {	
                    echo "
                        <script>
                        window.location='config.php';
                        alert('Cadastro de Série realizado com Sucesso!');
                        </script>";


                 
                }else 
                {
                    echo "
                        <script>
                        window.location='config.php';
                        alert('Série não Cadastrada, Tente Novamente!');
                        </script>";
                }
            }else
            echo 'Endereço do vídeo inválido';
        }else
        echo 'Endereço do vídeo inválido';
    }else
    echo 'Preencha todos os campos (título deve ter no mínimo 5 caracteres)';

            }
?>
  
<?php 
include "conecta.php";

if(isset($_POST['enviar_categoria'])){
    $nome_cat = $_POST['nome_cat'];
    $sql = "INSERT INTO categoria (nome_cat) values ('$nome_cat')";
    $resultado = pg_query($conexao,$sql); 
    if($resultado)
    {	
        echo "
            <script>
            window.location='config.php';
            alert('Cadastro de Categoria realizado com Sucesso!');
            </script>";


    }
    else 
    {
        echo "
            <script>
            window.location='config.php';
            alert('Categoria não foi Cadastrada, Tente Novamente!');
            </script>";
    }
}
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
    </head>

    <body>
        <div id="topo">
            <?php
            include "topo.php";
            ?>
        </div>
        <section>
            <article>
                <div id="add_serie">
                    <form name="form_serie" action="" method="post" id="form_serie" enctype="multipart/form-data">
                    
                    <label>Adicione a Série:</label>
                    <br><label> Nome da Série: <input type="text" id="nome" name="nome" placeholder="Breaking Bad" required/></label></br>
                    <br><label> Sinopse: <input type="text" id="sinopse_add" name="sinopse_add" required/></label></br>
                    <br><label>Categoria da Série:
                        <select name="categoria" required>
                        <?php
                            include "conecta.php";
                            $sql = "SELECT * FROM  categoria ORDER BY nome_cat ASC";
                            $resultado = pg_query($conexao, $sql);
                            $linhas = pg_num_rows($resultado);

                            for($i = 0; $i < $linhas; $i++)
                            {
                            $registro = pg_fetch_array($resultado);
                            echo "<option value='".$registro['id_cat']."'>".$registro['nome_cat']."</option>"; 
                            }

                        ?>
                        </select></label><br>
                    <input type="hidden" name="MAX_FILE_SIZE" value="300000"/>
                    <br><label> Banner Série: <input type="file" name="banner" id="banner" required/></label></br>
                    <br><label> Titulo do Video: <input type="text" name="title" id="title" size="40" maxlength="40"/></label></br>
                    <br><label for="url">Endereço: <input type="text" name="url" id="url" size="40"/></label></br>
                    <input type="reset" name="limpar" id="limpar" value="Limpar"/>
                    <input type="submit" name="enviar_serie" id="enviar_serie" value="Enviar Serie"/>    
                    </form>
                </div>
                
                <div id="add_categoria">
                    <form name="form_serie" action="" method="post" id="form_serie" enctype="multipart/form-data">
                        <br><label> Nome da categoria: <input type="text" id="nome_cat" name="nome_cat"/></label></br>               
                    <input type="submit" name="enviar_categoria" id="enviar_categoria" value="Enviar Categoria"/>    
                    </form>
                </div>
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