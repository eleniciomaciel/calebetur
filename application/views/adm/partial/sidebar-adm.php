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
                <a class="nav-link" href="javascript:void(0)">
                    <i class="material-icons">dashboard</i>
                    <p>Painel</p>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="javascript:void(0)" data-toggle="modal" data-target="#programaviaggemcarroModalLong">
                    <i class="material-icons">departure_board</i>
                    <p>Programar viagens</p>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="javascript:void(0)" data-toggle="modal" data-target="#agendaModal">
                    <i class="material-icons">event_note</i>
                    <p>viagens Agendada</p>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="javascript:void(0)"  data-toggle="modal" data-target="#listaTodosClientesModal">
                    <i class="material-icons">wc</i>
                    <p>Clientes</p>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="javascript:void(0)" data-toggle="modal" data-target="#list_encomendas">
                    <i class="material-icons">category</i>
                    <p>Encomendas</p>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="javascript:void(0)" data-toggle="modal" data-target="#motoristaViagemModal">
                    <i class="material-icons">airline_seat_recline_extra</i>
                    <p>Motorista/viagem</p>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="<?php echo site_url('logaut');?>">
                    <i class="material-icons">power_settings_new</i>
                    <p>Sair</p>
                </a>
            </li>
            <!-- <li class="nav-item active-pro ">
                <a class="nav-link" href="./upgrade.html">
                    <i class="material-icons">unarchive</i>
                    <p>Upgrade to PRO</p>
                </a>
            </li> -->
        </ul>
    </div>
</div>