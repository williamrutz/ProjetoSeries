<?php 
include "conecta.php";

if(isset($_POST['enviar'])){
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
                    echo "<h1> Cadastro Realizado com Sucesso!</h2>";
                    echo "<a href='config.php'> <h3>Clique para adicionar outra série.</h3></a><br>";
                    echo "<a href='inicio.php'> <h3>Clique para voltar a tela principal</hr></a>";


                }
                else 
                {
                    echo "<h1>Falha no Engano!</h1> <br>";
                    echo "<a href='config.php'> <h2>Tente Novamente! :D </h2></a>";
                }
            }else
            echo 'Endereço do vídeo inválido';
        }else
        echo 'Endereço do vídeo inválido';
    }else
    echo 'Preencha todos os campos (título deve ter no mínimo 5 caracteres)';

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
