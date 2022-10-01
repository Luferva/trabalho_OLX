<?php

function gravaLog ($id, $data, $tabela, $cat, $tipo)
{
    include('config.php');

    $query = "INSERT INTO log (id_usuario, data, tabela, descricao1, descricao2) values ('$id', '$data', '$tabela', '$cat', '$tipo')";
    $result = mysqli_query($con, $query);
}
?>