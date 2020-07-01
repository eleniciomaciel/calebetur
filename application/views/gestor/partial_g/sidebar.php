<div class="sidebar" data-color="purple" data-background-color="black" data-image="<?= base_url() ?>stylus/assets/img/sidebar-2.jpg">
  <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
  <div class="logo"><a href="#" class="simple-text logo-normal">
      <img src="<?= base_url() ?>stylus/assets/img/logo_geral.png" class="img-responsive" alt="Calebe Turismo">
    </a></div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item active  ">
        <a class="nav-link" href="./dashboard.html">
          <i class="material-icons">dashboard</i>
          <p>Painel</p>
        </a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#addUsuariosstaticBackdrop">
          <i class="material-icons">person</i>
          <p>Usuários</p>
        </a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#listaAgenciasModalLong">
          <i class="material-icons">store_mall_directory</i>
          <p>Agências</p>
        </a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#listaVeiculoModalLong">
          <i class="material-icons">directions_bus</i>
          <p>Veículos</p>
        </a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="#"  data-toggle="modal" data-target="#listaEtinarioModal">
          <i class="material-icons">location_ons</i>
          <p>Etinerários</p>
        </a>
      </li>
      <!-- <li class="nav-item ">
            <a class="nav-link" href="#">
              <i class="material-icons">bubble_chart</i>
              <p>Icons</p>
            </a>
          </li>

          <li class="nav-item ">
            <a class="nav-link" href="#">
              <i class="material-icons">notifications</i>
              <p>Notifications</p>
            </a>
          </li> -->
      <li class="nav-item">
        <a class="nav-link" href="<?php echo site_url('logaut');?>">
          <i class="material-icons">power_settings_new</i>
          <p>Sair</p>
        </a>
      </li>
    </ul>
  </div>
</div>