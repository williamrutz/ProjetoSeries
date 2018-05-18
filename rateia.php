<?php
include "conecta.php";

$nota_nova = $_POST['input-1'];
$id_serie = $_POST['id_serie'];

$sql = "SELECT * FROM avaliacao";
$resultado = pg_query($conexao, $sql);
$registro = pg_fetch_array($resultado);

if($registro['nota']<= 0){
    
    $votos = $registro['votos'] + 1;
    $sql = "INSERT into avaliacao(id_serie, nota , votos) values ('$id_serie', '$nota_nova' , '$votos')";

    $resultado = pg_query($conexao, $sql);

    if(!$resultado){
        echo "Falha na avaliation";
    }
    else{
        header("location:index.php");
    }

}
if($registro['nota']>= 1){
    $votos = $registro['votos'] + 1;
    $new_nota = ceil($nota_nova + $registro['nota']);
    $new_nota_final = ceil($new_nota/$votos);
    
    $sql = "UPDATE avaliacao SET votos = '$votos' , nota = '$new_nota_final' WHERE id_serie = '$id_serie'";
    $resultado = pg_query($conexao, $sql);

    if(!$resultado){
        echo "Falha na avaliation2";
    }
    else{
        header("location:index.php");
    }
}

?>