<?php
    $user = 'root';
    $password = '';
    $server = 'localhost';
    $bdName = 'funcCad';

    try
    {
        $pdo = new PDO("mysql:dbname=".$bdName."; host=".$server, $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        global $pdo;
    }catch(PDOException $e)
    {
        echo 'Erro verifique o arquivo de conexão: '. $e->getMessage();
    }
?>