<?php
include "conecta.php";
        if(isset($_POST['logar'])){
            $login = $_POST['login'];
            $senha = $_POST['senha'];
            
            $sql = "SELECT * FROM  usuario WHERE login = '$login' AND senha = '$senha'";
				$resultado = pg_query($conexao , $sql);
				$registro = pg_fetch_array($resultado);
				$linha = pg_num_rows($resultado);

				if($linha > 0)
				{
					session_start();
					$_SESSION['id_user'] = $registro['id_user'];
					/*header("location:index.php");*/
                    echo "<div id='result_login' width='20px' heigth='100px'>
                            <h3>Logado com Sucesso!</h3>
                          </div>";
                }
                else{
                    echo "<div id='result_login'width='20px' heigth='100px'>
                            <h3>Verifique seu email ou senha!</h3>
                          </div>";
                }
        }
        if(isset($_POST['cadastra'])){
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $cpf = $_POST['cpf'];
            $cidade = $_POST['cidade'];
            $login = $_POST['login'];
            $senha = $_POST['senha'];
            
            $sql = "INSERT INTO usuario (nome, email, cpf, cidade, login, senha) VALUES ('$nome','$email','$cpf', '$cidade', '$login', '$senha')";
            
            $resultado = pg_query($conexao, $sql);
            
            if($resultado){
                echo "Cadastro Foi Realizado com Sucesso!";
            }
            else 
            {
                echo "Nao realizado";
            }
            
        }
?>
<html>
<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="estilo_form.css">

</head>
<body>
    <div class="formulario">
    
		<form id="form" name="form" method="post" action="">
		
		<h1 id="text_cadastro">Faça Seu Cadastro! </h1>
		<label>Nome: <br><input type="text" width="150px" id="nome" name="nome" placeholder=" Digite seu nome!" required autofocus></label>
		<br><label>Email: <br><input type="email" id="email" name="email" width="150px" placeholder=" Digite seu email!" required/></label></br>
		<br><label>CPF: <br> <input type="text" width="150px" id="cpf" name="cpf" placeholder="Digite seu CPF!" required></label></br>
		<br><label>Cidade: <br><input type="text" id="cidade" name="cidade" width="150px" placeholder="Digite o nome da sua cidade!" required/></label></br>
		<br><label>Login:<br> <input type="text" id="login" name="login" width="150px" placeholder=" Digite um login!" required></label></br>
		<br><label>Senha:<br> <input type="password" id="senha" name="senha" width="150px" placeholder=" Digite sua senha!" required/></label></br>
		<br><label><input name="cadastra" id="cadastra" type="submit" value="Crie sua conta!"/></label></br>
	</form>
    </div>
    
    
    <div id="linha">
        <table border=0 align=left width=4 height=300 >
        <tr><td bgcolor=white></td></tr>
        </table>
    </div>    
    
    
    <div class="login">
       <form id="form_login" method="post" action="">
        <h1 id="text_login"> Ja é cadastrado!<br> Faça seu Login!!</br></h1>
        <br><label>Login: <br><input type="text" width="150px" id="login" name="login" placeholder=" Digite seu login!" required/></label></br>
        <br><label>Senha: <br><input type="password" width="150px" id="senha" name="senha" placeholder=" Digite sua senha!" required/></label></br>
        <br><label><input name="logar" id="logar" type="submit" value="Logar"</label></br>
</form>
    </div>
</body>
</html>
