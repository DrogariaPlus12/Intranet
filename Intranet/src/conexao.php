<?php

try {
    $connection = new PDO("sqlsrv:server=192.168.1.20,1433; Database=SisplusGestao", "jose", "123");
    $statement = $connection->prepare("SELECT * FROM dbo.RegraUnimed;");
    $statement->execute();
    $SisplusGestao = $statement->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $erro) {
    echo "Erro na conexão:".$erro->getMessage();
}