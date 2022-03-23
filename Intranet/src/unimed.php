<?php
include_once "conexao.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <script src="./src/js/scripts.js"></script>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--Stylo proprio-->
    <link rel="stylesheet" href="../scss/main.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
                          
    <title>Intranet</title>
  </head>
  <body>
  <nav class="navbar navbar-light" style="background: linear-gradient(to top,#4f638e,#2c3d67,#2c3d67,#1b2335);">
  <!-- Conteúdo do navbar -->
</nav>
  <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background: linear-gradient(to top,#3c4e71,#3c4e71);">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Alterna navegação">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">

      <li class="nav-item active">
        <a class="nav-link" style="color: #fff;" href="#"><span class="sr-only">(Página atual)</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" style="color: #fff;" href="../src/televendas.php">TeleVendas</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" style="color: #fff;" href="../intitucional/">Institucional</a>
      </li>
      

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle"  style="color: #fff;" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Informação
        </a>
        
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="../src/ramal.php">Ramal</a>
          <a class="dropdown-item" href="../src/impressora.php">Impressora</a>
          <a class="dropdown-item" href="../src/Unimed.php">Unimed</a>
        </div>
      </li>
    </ul>
  </div>
</nav>

<section>
<?php
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    //var_dump($dados);
    ?>
    <h2>Pesquisar Serviço Unimed</h2>

    <form method="POST" action="">
        <label>Nome: </label>
        <select name="nome_usuario" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                    <option value="">Selecione</option>
                    <option value="camp">Campinas</option>
                    <option value="Flamb">Flamboyant</option>
                    <option value="24out">24Outubro</option>
                    <option value="Eldo">Eldorado</option>
                    <option value="Acheirv">AcheiPark RV</option>
                    <option value="AcheiJH">AcheiPark JH</option>
                    <option value="AcheiJL">AcheiParck JL</option>            
        </select>

        <input type="submit" class="btn btn-primary" name="pesqUsuario" id="pesqUsuario"><br><br>
    </form>
    <div class="alert alert-success" role="alert">
  <h4 class="alert-heading">Tipos de planos</h4>
  <?php

if (!empty($dados['pesqUsuario'])) {
    $Loja = "%" . $dados['nome_usuario'] . "%";

    $query_usuarios = "SELECT  Seq, Loja, CNPJ, DescricaoTipoPlano, Acomodacao, FaixaSalario, Desconto, Contrato FROM dbo.RegraUnimed WHERE Loja LIKE :Loja GROUP BY  Seq, Loja, CNPJ, DescricaoTipoPlano, Acomodacao, FaixaSalario, Desconto, Contrato";
    $result_usuarios = $connection->prepare($query_usuarios);
    $result_usuarios->bindParam(':Loja', $Loja, PDO::PARAM_STR);

    $result_usuarios->execute();

    while ($row_usuario = $result_usuarios->fetch(PDO::FETCH_ASSOC)) {
        //var_dump($row_usuario);
        extract($row_usuario);
        echo "Seq: $Seq <br>";
        echo "Loja: $Loja <br>";
        echo "CNPJ: $CNPJ <br>";
        echo "DescricaoTipoPlano: $DescricaoTipoPlano <br>";
        echo "Acomodacao: $Acomodacao <br>";
        echo "FaixaSalario: $FaixaSalario <br>";
        echo "Desconto: $Desconto <br>";
        echo "Contrato: $Contrato <br>";          
        echo "<hr>";
    }
}

?>


  </div>

   
</section>

    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>