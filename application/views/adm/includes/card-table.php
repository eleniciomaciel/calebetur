<div class="col-md-12">
    <div class="card">
        <div class="card-header card-header-tabs card-header-warning">
            <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                    <span class="nav-tabs-title">Atividades:</span>
                    <ul class="nav nav-tabs" data-tabs="tabs">
                        <li class="nav-item">
                            <a class="nav-link active" href="#profile" data-toggle="tab">
                                <i class="material-icons">departure_board</i> Viagens/Clientes
                                <div class="ripple-container"></div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#messages" data-toggle="tab">
                                <i class="material-icons">directions_bus</i> COnsultar programação
                                <div class="ripple-container"></div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#settings" data-toggle="tab">
                                <i class="material-icons">cloud</i> Relatório de viagem
                                <div class="ripple-container"></div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane active table-responsive" id="profile">

                <?php
                    $this->load->view('adm/includes/task/tab-cliente_viagem');
                ?>

                </div>
                <div class="tab-pane table-responsive" id="messages">

                <?php
                    $this->load->view('adm/includes/task/tab-carro_programacao');
                ?>

                </div>
                <div class="tab-pane" id="settings">
                <?php
                    $this->load->view('adm/includes/task/tab-relatorioCarroViagem');
                ?>
                </div>
            </div>
        </div>
    </div>
</div>