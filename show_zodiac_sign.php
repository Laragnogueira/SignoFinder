<?php include('layouts/header.php'); ?>

<div class="container mt-5 content">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow-lg">
        <div class="card-body">
          <h2 class="text-center mb-4">Seu Signo</h2>

          <?php
          $data_nascimento = $_POST['data_nascimento'];
          $signos = simplexml_load_file("signos.xml");

          function converteData($data) {
            return DateTime::createFromFormat('d/m', $data)->format('m-d');
          }

          $data_nascimento_formatada = date('m-d', strtotime($data_nascimento));

          $signo_encontrado = false;
          foreach ($signos->signo as $signo) {
            $dataInicio = converteData((string) $signo->dataInicio);
            $dataFim = converteData((string) $signo->dataFim);

            if (($data_nascimento_formatada >= $dataInicio) && ($data_nascimento_formatada <= $dataFim)) {
              echo "<h3 class='text-center text-primary'>{$signo->signoNome}</h3>";
              echo "<p class='text-center'>{$signo->descricao}</p>";
              $signo_encontrado = true;
              break;
            }
          }

          if (!$signo_encontrado) {
            echo "<p class='text-center text-danger'>Não foi possível determinar o signo. Verifique a data inserida.</p>";
          }
          ?>

          <div class="text-center mt-4">
            <a href="index.php" class="btn btn-secondary">Voltar</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include('layouts/footer.php'); ?>
