<!DOCTYPE html>
<html lang="pt-br">
<title>Dados-encomenda</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link href='https://fonts.googleapis.com/css?family=RobotoDraft' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
  html,
  body,
  h1,
  h2,
  h3,
  h4,
  h5 {
    font-family: "RobotoDraft", "Roboto", sans-serif
  }

  .w3-bar-block .w3-bar-item {
    padding: 16px
  }
</style>

<body>

  <!-- Side Navigation -->
  <nav class="w3-sidebar w3-bar-block w3-collapse w3-white w3-animate-left w3-card" style="z-index:3;width:320px;" id="mySidebar">
    <a href="javascript:void(0)" class="w3-bar-item w3-button w3-border-bottom w3-large">
      <img src="<?= base_url() ?>stylus/assets/img/logo_geral.png" class="img-responsive" alt="Calebe Turismo" style="width:60%;">
    </a>


    <div class="w3-tag w3-round w3-green" style="padding:3px; width:100%;">
      <div class="w3-tag w3-round w3-green w3-border w3-border-white">
        Bem vindo - Calebetur emcomendas
      </div>
    </div>


    <a href="javascript:void(0)" onclick="w3_close()" title="Close Sidemenu" class="w3-bar-item w3-button w3-hide-large w3-large">Fechar <i class="fa fa-remove"></i></a>

  </nav>
  <?php

  if (isset($view_encomendas['0']->controle_key_vc)) {
  ?>
    <!-- Modal that pops up when you click on "New Message" -->
    <div id="id01" class="w3-modal" style="z-index:4">
      <div class="w3-modal-content w3-animate-zoom">
        <div class="w3-container w3-padding w3-red">
          <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-red w3-right w3-xxlarge"><i class="fa fa-remove"></i></span>
          <h2>Enviar mensagem</h2>
        </div>

        <form>
          <div class="w3-panel">
            <label>Para:</label>
            <input class="w3-input w3-border w3-margin-bottom" type="text" value="calebetur@gmail.com" disabled>
            <label>De:</label>
            <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="meu-email@email.com" required>
            <label>Assunto:</label>
            <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="O que desejo saber">
            <input class="w3-input w3-border w3-margin-bottom" style="height:150px" placeholder="Sua mensagem aqui..." required>
            <div class="w3-section">
              <a class="w3-button w3-red" onclick="document.getElementById('id01').style.display='none'">Cancelar  <i class="fa fa-remove"></i></a>
              <a class="w3-button w3-light-grey w3-right">Enviar  <i class="fa fa-paper-plane"></i></a>
            </div>
          </div>
        </form>

      </div>
    </div>

    <!-- Overlay effect when opening the side navigation on small screens -->
    <div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="Close Sidemenu" id="myOverlay"></div>

    <!-- Page content -->
    <div class="w3-main" style="margin-left:320px;">
      <i class="fa fa-bars w3-button w3-white w3-hide-large w3-xlarge w3-margin-left w3-margin-top" onclick="w3_open()"></i>

      <a href="javascript:void(0)" class="w3-hide-large w3-red w3-button w3-right w3-margin-top w3-margin-right" onclick="document.getElementById('id01').style.display='block'">
        <i class="fa fa-pencil"></i>
      </a>

      <div id="Borge" class="w3-container person">
        <br>
        <h5 class="w3-opacity">Protocolo da viagem: <?php echo $view_encomendas['0']->controle_key_vc; ?></h5>

        <h4><i class="fa fa-clock-o"></i> Data do envio: <?php echo date("d/m/Y H:i", strtotime($view_encomendas['0']->data_cadastro_enc)); ?>.</h4>


        <div class="w3-card-4">
          <header class="w3-container w3-light-grey">
            <h3>Remetente: <?php echo $view_encomendas['0']->fk_nome_ciente_cl; ?></h3>
          </header>

          <div class="w3-container">
            <p>Destinatário</p>
            <hr>
            <img src="https://www.w3schools.com/w3css/img_avatar3.png" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
            <p>Vai ser retirado por: <?php echo $view_encomendas['0']->remetente_nome_enc; ?></p>
          </div>
          <button class="w3-button w3-block w3-dark-grey">Nº doc.: retirada: <?php echo $view_encomendas['0']->remetente_rg_enc; ?></button>
        </div>


        <p style="text-align: center;">Status da emcomenda</p>

        <?php

        if ($view_encomendas['0']->status_encomenda_enc == 0) {
        ?>
          <div class="w3-panel w3-pale-red w3-leftbar w3-border-red">
            <p><i class="fa fa-truck"></i> Aguardando embarque.</p>
          </div>
        <?php
        } elseif ($view_encomendas['0']->status_encomenda_enc == 1) {
        ?>
          <div class="w3-panel w3-pale-blue w3-leftbar w3-border-blue">
            <p><i class="fa fa-truck"></i> Encomenda em transito.</p>
          </div>
        <?php
        } elseif ($view_encomendas['0']->status_encomenda_enc == 2) {
        ?>
          <div class="w3-panel w3-pale-yellow w3-leftbar w3-border-yellow">
            <p><i class="fa fa-truck"></i> Encomenda chegou ao destino e aguarda retirada...</p>
          </div>
        <?php
        } else {
        ?>
          <div class="w3-panel w3-pale-green  w3-leftbar w3-border-green">
            <p><i class="fa fa-truck"></i> Encomenda entregue.</p>
          </div>
        <?php
        }

        ?>

        <hr>

        <table class="w3-table-all">
          <thead>
            <tr class="w3-red">
              <th>Descrição</th>
              <th>Quantidade</th>
              <th>Código</th>
              <th>Valor</th>
            </tr>
          </thead>

          <?php
          foreach ($view_encomendas as $key) {
          ?>
            <tr>
              <td><?php echo $key->descricao_peca_enc; ?></td>
              <td><?php echo $key->qtd_produto_enc; ?></td>
              <td><?php echo $key->codigo_produto_enc; ?></td>
              <td><?php echo number_format($key->valor_produto_enc, 2, ',', '.'); ?></td>
            </tr>
          <?php
          }
          ?>
        </table>

        <br>
        <button type="button" class="w3-btn w3-round-xxlarge w3-indigo" onclick="return location.reload();">Atualizar</button>
      </div>

    </div>
  <?php
  } else {
  ?>
    <div class="w3-panel w3-red">
      <h3>Ops!</h3>
      <p>Algo deu errado, leia a página novamente com o Qr Code.</p>
    </div>

  <?php
  }


  ?>

  <script>
    var openInbox = document.getElementById("myBtn");
    openInbox.click();

    function w3_open() {
      document.getElementById("mySidebar").style.display = "block";
      document.getElementById("myOverlay").style.display = "block";
    }

    function w3_close() {
      document.getElementById("mySidebar").style.display = "none";
      document.getElementById("myOverlay").style.display = "none";
    }

    function myFunc(id) {
      var x = document.getElementById(id);
      if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
        x.previousElementSibling.className += " w3-red";
      } else {
        x.className = x.className.replace(" w3-show", "");
        x.previousElementSibling.className =
          x.previousElementSibling.className.replace(" w3-red", "");
      }
    }

    openMail("Borge")

    function openMail(personName) {
      var i;
      var x = document.getElementsByClassName("person");
      for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
      }
      x = document.getElementsByClassName("test");
      for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" w3-light-grey", "");
      }
      document.getElementById(personName).style.display = "block";
      event.currentTarget.className += " w3-light-grey";
    }
  </script>

  <script>
    var openTab = document.getElementById("firstTab");
    openTab.click();
  </script>

</body>

</html>