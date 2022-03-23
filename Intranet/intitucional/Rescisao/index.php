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
<form action="?act=save" method="POST" name="form1" >
                <h1>Rescisão</h1>
                <hr>
                <input type="hidden" name="id" <?php
                 
                // Preenche o id no campo id com um valor "value"
                if (isset($id) && $id != null || $id != "") {
                    echo "value=\"{$id}\"";
                }
                ?> />
                CPF:
               <input type="text" name="CPF" <?php
 
               if (isset($CPF) && $CPF != null || $CPF != "") {
                   echo "value=\"{$CPF}\"";
               }
               ?> />
                Nome:
               <input type="text" name="NomeTitular" <?php
 
               // Preenche o nome no campo nome com um valor "value"
               if (isset($NomeTitular) && $NomeTitular != null || $NomeTitular != "") {
                   echo "value=\"{$NomeTitular}\"";
               }
               ?> />
                Observação:
               <input type="text" name="Observacao" <?php
 
       
               if (isset($Observacao) && $Observacao != null || $Observacao != "") {
                   echo "value=\"{$Observacao}\"";
               }
               ?> />

                 Pendente:
               <select name="Pendente" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                    <option value="">Selecione</option>
                    <option value="True">Sim</option>
                    <option value="False">Não</option>
                    
                </select><?php
 
               ?> 
               <input type="submit" class="btn btn-primary" value="salvar" />
               <hr>
            </form>
            <table border="1" width="100%">
                <tr>
                    <th>CPF</th>
                    <th>NomeTitular</th>
                    <th>Observacao</th>
                    <th>Pendente</th>
                    <th>Ações</th>
                </tr>
                <?php
 
                // Bloco que realiza o papel do Read - recupera os dados e apresenta na tela
                try {
                    $stmt = $connection->prepare("SELECT * FROM dbo.DadosRescisao Where Pendente = 'True' order by NomeTitular");
                    if ($stmt->execute()) {
                        while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                            echo "<tr>";
                            echo "<td>".$rs->CPF."</td><td>".$rs->NomeTitular."</td><td>".$rs->Observacao
                                       ."</td>
                                       <td>".$rs->Pendente
                                       ."</td><td><center><a href=\"?act=upd&id=".$rs->id."\">Alterar</a>"
                                       ."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
                                       ."<a href=\"?act=del&id=".$rs->id."\">Excluir</a></center></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "CPF  ";
                    }
                } catch (PDOException $erro) {
                    echo "Erro: ".$erro->getMessage();
                }
                ?>
            </table>
     
</section>

    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>