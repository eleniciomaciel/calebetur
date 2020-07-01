<!DOCTYPE html>
<html>
<title>Fluxo de passageiros</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<style>
    html,
    body,
    h1,
    h2,
    h3,
    h4,
    h5 {
        font-family: "Raleway", sans-serif
    }
</style>

<body class="w3-light-grey">

    <!-- Top container -->
    <div class="w3-bar w3-top w3-black w3-large" style="z-index:4">
        <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>
        <span class="w3-bar-item w3-right">Calebetur</span>
    </div>

    <!-- Sidebar/menu -->
    <nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
        <div class="w3-container w3-row">
            <div class="w3-col s4">
                <img src="https://www.w3schools.com/w3images/avatar2.png" class="w3-circle w3-margin-right" style="width:46px">
            </div>
            <div class="w3-col s8 w3-bar">
                <span>Bem vindo, <strong><?= $nome_motor[0]->eu_dirijo ?></strong></span><br>
            </div>
        </div>
        <hr>
        <div class="w3-container">
            <h5>Painel de controle</h5>
        </div>
        <div class="w3-bar-block">
            <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Fechar Menu</a>
            <a href="#" class="w3-bar-item w3-button w3-padding w3-blue"><i class="fa fa-map fa-fw"></i>  Informações da viagem</a>
            <a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-calendar-check-o fa-fw"></i>  <?= date("d/m/Y", strtotime($dados_viagem['0']->data_saida_vc)) ?></a>
            <a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-clock-o fa-fw"></i>  <?= $dados_viagem[0]->hora_saida_vc ?></a>
            <a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-bus fa-fw"></i>  <?= $dados_viagem[0]->placa_veic ?></a>
            <a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-map-signs fa-fw"></i>  <?= $dados_viagem[0]->my_city_ch ?></a>
            <a href="#" class="w3-bar-item w3-button w3-padding" onclick="refresh()">
                <i class="fa fa-history fa-fw"></i>  Atualizar
            </a>
        </div>
    </nav>


    <!-- Overlay effect when opening sidebar on small screens -->
    <div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

    <!-- !PAGE CONTENT! -->
    <div class="w3-main" style="margin-left:300px;margin-top:43px;">

        <!-- Header -->
        <header class="w3-container" style="padding-top:22px">
            <h5><b><i class="fa fa-dashboard"></i> Meu painel de viagem</b></h5>
        </header>

        <div class="w3-row-padding w3-margin-bottom">
            <div class="w3-container">
                <div class="w3-container w3-blue w3-padding-16">
                    <div class="w3-left"><i class="fa fa-bus w3-xxxlarge"></i></div>
                    <div class="w3-right">
                        <h3><?= $total_g[0]->total_users ?></h3>
                    </div>
                    <div class="w3-clear"></div>
                    <h4>Passageiros</h4>
                </div>
            </div>


        </div>

        <div class="w3-panel">
            <div class="w3-row-padding" style="margin:0 -16px">

                <div class="w3-container">
                    <h5>Viajantes</h5>
                    <table class="w3-table w3-striped w3-white">
                        <tr class="w3-red">
                            <th>Passageiro</th>
                            <th>Poltrona</th>
                            <th>Destino</th>
                            <th>Ações</th>
                        </tr>
                        <?php

                        foreach ($dados_viagem as $row) {
                        ?>
                            <tr>
                                <td>
                                    <i class="fa fa-user w3-text-red w3-large"></i>
                                    &nbsp;<?php echo $row->fk_nome_ciente_cl; ?>
                                </td>
                                <td>
                                    <i class="material-icons"> event_seat </i>&nbsp;
                                    <?php echo $row->poltrona_carro_cpcv; ?>
                                </td>
                                <td>
                                    <i class="material-icons"> directions </i>&nbsp;
                                    <?php echo $row->cliente_destino_cpcv; ?>
                                </td>
                                <td>
                                    <button onclick="document.getElementById('id01').style.display='block'" class="dadosGeralPassageiro w3-button w3-round-xxlarge w3-blue" id="<?php echo $row->id_cpcv; ?>">
                                        Geral <i class="fa fa-plus"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php
                        }

                        ?>
                    </table>
                </div>
            </div>
        </div>


        <!-- Footer -->
        <footer class="w3-container w3-padding-16 w3-light-grey">
            <h4>Calebetur</h4>
            <p>Distribuído por <a href="#" target="_blank">T&E Consultoria</a></p>
        </footer>

        <!-- End page content -->
    </div>

    <!-- ===================   popap dados passageiro  ============================= -->
    <div class="w3-container">

            <div id="id01" class="w3-modal w3-animate-zoom">
                <div class="w3-modal-content">
                    <header class="w3-container w3-teal">
                        <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                        <h2>Informações do passageiro</h2>
                    </header>
                    <div class="w3-container">
                        <!-- ===================   form  ============================= -->
                        <form action="/action_page.php" class="w3-container w3-card-4 w3-light-grey w3-text-blue w3-margin">
                            <h2 class="w3-center">Dados pessoais</h2>

                            <div class="w3-row w3-section">
                                <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user"></i></div>
                                <div class="w3-rest">
                                <label>Passageiro</label>
                                    <input type="text" class="w3-input w3-border" id="pas_nome" disabled>
                                </div>
                            </div>

                            <div class="w3-row w3-section">
                                <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-id-card"></i></div>
                                <div class="w3-rest">
                                <label>RG</label>
                                    <input class="w3-input w3-border" id="pass_rg" type="text" disabled>
                                </div>
                            </div>

                            <div class="w3-row w3-section">
                                <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-id-card-o"></i></div>
                                <div class="w3-rest">
                                <label>CPF</label>
                                    <input class="w3-input w3-border" id="pass_cpf" type="text" disabled>
                                </div>
                            </div>

                            <div class="w3-row w3-section">
                                <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-map-signs"></i></div>
                                <div class="w3-rest">
                                <label>Linha/saída</label>
                                    <input class="w3-input w3-border" id="pass_saida" type="text" disabled>
                                </div>
                            </div>

                            <div class="w3-row w3-section">
                                <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-map-marker"></i></div>
                                <div class="w3-rest">
                                <label>Linha/chegada</label>
                                    <input class="w3-input w3-border" id="pass_destino" type="text" disabled>
                                </div>
                            </div>

                            <div class="w3-row w3-section">
                                <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-street-view"></i></div>
                                <div class="w3-rest">
                                <label>Poltrona</label>
                                    <input class="w3-input w3-border" id="pass_poltrona" type="text" disabled>
                                </div>
                            </div>

                            <div class="w3-row w3-section">
                                <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-phone"></i></div>
                                <div class="w3-rest">
                                <label>Telefone</label>
                                    <input class="w3-input w3-border" id="pass_tel" type="text" disabled>
                                </div>
                            </div>

                            <div class="w3-row w3-section">
                                <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-calendar-check-o"></i></div>
                                <div class="w3-rest">
                                <label>Data e hora da saída</label>
                                    <input class="w3-input w3-border" id="pass_data_saida" type="text" disabled>
                                </div>
                            </div>

                            <div class="w3-row w3-section">
                                <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-home"></i></div>
                                <div class="w3-rest">
                                <label>Agência de cadastro</label>
                                    <input class="w3-input w3-border" id="pass_agencia" type="text" disabled>
                                </div>
                            </div>

                            <div class="w3-row w3-section">
                                <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-handshake-o"></i></div>
                                <div class="w3-rest">
                                <label>Status da poltrona</label>
                                    <input class="w3-input w3-border" id="pass_status_poltrona" type="text" disabled>
                                </div>
                            </div>

                            <div class="w3-row w3-section">
                                <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-pencil"></i></div>
                                <div class="w3-rest">
                                <label>Observação</label>
                                    <input class="w3-input w3-border" id="pass_observacao" type="text" disabled>
                                </div>
                            </div>

                        </form>
                        <!-- ===================   fim form  ============================= -->
                    </div>
                    <footer class="w3-container w3-teal">
                        <p>*Proibido o repasse dessas indormações</p>
                    </footer>
                </div>
            </div>
        </div>
    <!-- ===================   fim popap  ============================= -->
    <script>
        // Get the Sidebar
        var mySidebar = document.getElementById("mySidebar");

        // Get the DIV with overlay effect
        var overlayBg = document.getElementById("myOverlay");

        // Toggle between showing and hiding the sidebar, and add overlay effect
        function w3_open() {
            if (mySidebar.style.display === 'block') {
                mySidebar.style.display = 'none';
                overlayBg.style.display = "none";
            } else {
                mySidebar.style.display = 'block';
                overlayBg.style.display = "block";
            }
        }

        // Close the sidebar with the close button
        function w3_close() {
            mySidebar.style.display = "none";
            overlayBg.style.display = "none";
        }


        function refresh() {
            setTimeout(function() {
                location.reload()
            }, 100);
        }
    </script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.dadosGeralPassageiro', function() {
                var id_p = $(this).attr("id");
                $.ajax({
                    url: "<?= site_url('lista-geral-dadospassageiro-poltrona/') ?>" + id_p,
                    method: "GET",
                    data: {
                        id_p: id_p
                    },
                    dataType: "json",
                    success: function(data) {
                        $('#pas_nome').val(data.pas_nome);
                        $('#pass_tel').val(data.pass_tel);
                        $('#pass_poltrona').val(data.pass_poltrona);
                        $('#pass_status_poltrona').val(data.pass_status_poltrona);
                        $('#pass_saida').val(data.pass_saida);
                        $('#pass_destino').val(data.pass_destino);
                        $('#pass_observacao').val(data.pass_observacao);
                        $('#pass_ststuas_embarque').val(data.pass_ststuas_embarque);
                        $('#pass_cpf').val(data.pass_cpf);
                        $('#pass_rg').val(data.pass_rg);
                        $('#pass_data_saida').val(data.pass_data_saida);
                        $('#pass_agencia').val(data.pass_agencia);
                    }
                })
            });
        });
    </script>
</body>

</html>