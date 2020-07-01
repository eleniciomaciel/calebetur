<div class="card">
    <div class="card-header card-header-tabs card-header-warning">
        <div class="nav-tabs-navigation">
            <div class="nav-tabs-wrapper">
                <span class="nav-tabs-title">Tarefas:</span>
                <ul class="nav nav-tabs" data-tabs="tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="#profile" data-toggle="tab">
                                <i class="material-icons">enhanced_encryption</i> Acessos
                            <div class="ripple-container"></div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#messages" data-toggle="tab">
                            <i class="material-icons">departure_board</i> Manutenção
                            <div class="ripple-container"></div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#settings" data-toggle="tab">
                            <i class="material-icons">vpn_lock</i> Log
                            <div class="ripple-container"></div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#motoristas" data-toggle="tab">
                        <i class="material-icons"> airline_seat_recline_extra </i> Motoristas
                        <div class="ripple-container"></div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="tab-content">

            <div class="tab-pane active" id="profile">
                <?php
                    $this->load->view('gestor/includes/nav-tabs_a');
                ?>
            </div>

            <div class="tab-pane" id="messages">
                <?php
                    $this->load->view('gestor/includes/nav-tabs_b');
                ?>
            </div>

            <div class="tab-pane" id="settings">
                <?php
                    $this->load->view('gestor/includes/nav-tabs_c');
                ?>
            </div>

            <div class="tab-pane" id="motoristas">
                <?php
                    $this->load->view('gestor/includes/nav-tabs_d');
                ?>
            </div>

        </div>
    </div>
</div>