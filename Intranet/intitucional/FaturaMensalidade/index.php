<?php
include_once "conexao.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="https://static.wixstatic.com/media/157734_1e57fd2b60d2447d9dcd9d5613ac2f38.png/v1/fill/w_208,h_95,al_c,q_85,usm_0.66_1.00_0.01/157734_1e57fd2b60d2447d9dcd9d5613ac2f38.webp" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../main.css">
    <title>Sistemas</title>
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
        <a class="nav-link" style="color: #fff;" href="../dashboard.php">Inicio</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" style="color: #fff;" href="../Admissão">Admissão</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" style="color: #fff;" href="../Rescisao">Rescisão</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" style="color: #fff;" href="../planoProprio">Plano Proprio</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" style="color: #fff;" href="../FaturaMensalidade">Fatura Mensalidade</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" style="color: #fff;" href="../FaturaServico">Fatura Seviço Unimed</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" style="color: #fff;" href="../dadossocios">Dados Socios</a>
      </li>
    </ul>
  </div>
</nav>

<!--section_aniversariantes-->

<section>
<?php
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    //var_dump($dados);
    ?>
    <h2>Pesquisar Mensalidade Unimed</h2>

    <form method="POST" action="">
        <label>Nome: </label>
        <input type="text" name="nome_usuario" placeholder="Digite o nome" value="<?php if(isset($dados['nome_usuario'])){ echo $dados['nome_usuario']; } ?>"><br><br>

        <input type="submit" name="pesqUsuario" id="pesqUsuario"><br><br>
    </form>

    <?php

    if (!empty($dados['pesqUsuario'])) {
        $NomeTitular = "%" . $dados['nome_usuario'] . "%";
    

        $query_usuarios = "SELECT  CPF, NomeBeneficiario, DescricaoTipoPlano, DataInicioVigencia, Seq, Competencia, NomeEmpresa, CodigoGrauDependencia, Sum(ValorFaturado) as Valor FROM dbo.FaturaTaxasUnimed  WHERE NomeTitular LIKE :NomeTitular GROUP BY CPF, NomeBeneficiario, NomeTitular, DescricaoTipoPlano, DataInicioVigencia, Seq, Competencia, NomeEmpresa, CodigoGrauDependencia";
        $result_usuarios = $connection->prepare($query_usuarios);
        $result_usuarios->bindParam(':NomeTitular', $NomeTitular, PDO::PARAM_STR);

        $result_usuarios->execute();

        while ($row_usuario = $result_usuarios->fetch(PDO::FETCH_ASSOC)) {
            //var_dump($row_usuario);
            extract($row_usuario);
            echo "NomeBeneficiario: $NomeBeneficiario <br>";
            echo "CPF: $CPF <br>";
            echo "DescricaoTipoPlano: $DescricaoTipoPlano <br>";
            echo "DataInicioVigencia: $DataInicioVigencia <br>";
            echo "Seq: $Seq <br>";
            echo "Competencia: $Competencia <br>";
            echo "NomeEmpresa: $NomeEmpresa <br>";
            echo "CodigoGrauDependencia: $CodigoGrauDependencia <br>";
            echo "ValorFaturado: $Valor <br>";
            

            echo "<hr>";
        }
    }

    ?>
     
</section>

    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>