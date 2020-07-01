<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-ticket</title>
    <link href="<?= base_url() ?>stylus/assets/fontes/fontawesome-free-5.12.1-web/css/all.css" rel="stylesheet">
    <script defer src="<?= base_url() ?>stylus/assets/fontes/fontawesome-free-5.12.1-web/js/all.js"></script>
    <style type="text/css">
        .tg {
            border-collapse: collapse;
            border-spacing: 0;
            border-width: 1px;
            border-style: solid;
            border-color: black;
        }

        .tg td {
            font-family: Arial, sans-serif;
            font-size: 14px;
            padding: 10px 5px;
            border-style: solid;
            border-width: 0px;
            overflow: hidden;
            word-break: normal;
        }

        .tg th {
            font-family: Arial, sans-serif;
            font-size: 14px;
            font-weight: normal;
            padding: 10px 5px;
            border-style: solid;
            border-width: 0px;
            overflow: hidden;
            word-break: normal;
        }

        .tg .tg-lboi {
            border-color: inherit;
            text-align: left;
            vertical-align: middle
        }

        .tg .tg-0x09 {
            background-color: #9b9b9b;
            text-align: left;
            vertical-align: top
        }

        .tg .tg-baqh {
            text-align: center;
            vertical-align: top
        }

        .tg .tg-w747 {
            background-color: #dae8fc;
            text-align: left;
            vertical-align: top
        }

        .tg .tg-7geq {
            background-color: #ffffc7;
            text-align: center;
            vertical-align: top
        }

        .tg .tg-07c9 {
            background-color: #ffffc7;
            border-color: inherit;
            text-align: center;
            vertical-align: middle
        }

        .tg .tg-lqy6 {
            text-align: right;
            vertical-align: top
        }

        .tg .tg-5qgy {
            background-color: #fcff2f;
            border-color: inherit;
            text-align: left;
            vertical-align: middle
        }

        .tg .tg-ew1g {
            background-color: #fcff2f;
            border-color: inherit;
            text-align: center;
            vertical-align: middle
        }

        .tg .tg-0a7q {
            border-color: #000000;
            text-align: left;
            vertical-align: middle
        }

        .tg .tg-8o2n {
            border-color: #000000;
            text-align: right;
            vertical-align: middle
        }

        .tg .tg-mfhl {
            background-color: #ffffc7;
            border-color: inherit;
            text-align: center;
            vertical-align: top
        }

        .tg .tg-0lax {
            text-align: left;
            vertical-align: top
        }

        .tg .tg-d53b {
            background-color: #dae8fc;
            text-align: center;
            vertical-align: top
        }
    </style>
</head>

<body>
<?php
if($dd_clinete['0']->data_saida_vc >= date("Y-m-d", strtotime('-1 days'))){
    ?>
        <table class="tg">
        <tr>
            <td class="tg-lboi" colspan="2"><img src="<?= base_url() ?>stylus/assets/img/logo-qr_code.png" alt="E-ticket" srcset=""> </td>
        </tr>
        <tr>
            <th class="tg-5qgy">Empresa: <span style="font-weight:bold">Calebe Tur</span></th>
            <th class="tg-ew1g">Razão Social<br><span style="font-weight:bold"><?php echo $dd_clinete['0']->cnpj_ag; ?></span><br></th>
        </tr>
        <tr>
            <td class="tg-lboi" colspan="2">Endereço: <?php echo $dd_clinete['0']->endereco_ag; ?></td>
        </tr>
        <tr>
            <td class="tg-07c9" colspan="2">Linha: <?php echo $dd_clinete['0']->my_city_sai; ?> / <?php echo $dd_clinete['0']->my_city_ch; ?></td>
        </tr>
        <tr>
            <td class="tg-0a7q">Data da saída: <?php echo date("d/m/Y", strtotime($dd_clinete['0']->data_saida_vc)); ?></td>
            <td class="tg-8o2n">Horário da saída: <?php echo date("H:i", strtotime($dd_clinete['0']->hora_saida_vc)); ?></td>
        </tr>
        <tr>
            <td class="tg-0a7q">Tipo de pagamento:</td>
            <td class="tg-8o2n"><?php echo $dd_clinete['0']->tipo_pagamento_cpcv; ?></td>
        </tr>
        <tr>
            <td class="tg-0a7q">Valor pago:</td>
            <td class="tg-8o2n">R$ <?php echo $dd_clinete['0']->valor_poltrona_cpcv; ?></td>
        </tr>
        <tr>
            <td class="tg-mfhl" colspan="2">Nº da viagem:<br><?php echo $dd_clinete['0']->controle_key_vc; ?></td>
        </tr>
        <tr>
            <td class="tg-0lax">Data do pagamento:</td>
            <td class="tg-lqy6"><?php echo date("d/m/Y H:i:s", strtotime($dd_clinete['0']->data_cadastro_cpcv)); ?></td>
        </tr>
        <tr>
            <td class="tg-w747"><i class="fas fa-user-tag"></i>&nbsp;Cliente:<br><i class="fas fa-address-card"></i>&nbsp;Cpf:<br><i class="fas fa-chair"></i>&nbsp;Poltrona</td>
            <td class="tg-d53b">
                <?php echo $dd_clinete['0']->fk_nome_ciente_cl; ?><br>
                <?php echo $dd_clinete['0']->cpf_cl; ?><br>
                <?php echo $dd_clinete['0']->poltrona_carro_cpcv; ?>
            </td>
        </tr>
        <tr>
            <td class="tg-0x09">Origem: <?php echo $dd_clinete['0']->cliente_saida_cpcv; ?></td>
            <td class="tg-0x09">Destino: <?php echo $dd_clinete['0']->cliente_destino_cpcv; ?></td>
        </tr>
        <tr>
            <td class="tg-mfhl" colspan="2">Bagagens:<br>
                <ol>
                    <?php
                    if ($db_baganens->num_rows() > 0) {
                        foreach ($db_baganens->result() as $bg) {
                    ?>
                        <li><?php echo 'Cod.: '.$bg->codigo_bagagem_cb .' - Desc.: '.$bg->descricao_bagagem_cb . ' - Qtd - ' . $bg->qtd_bagagem_cb; ?></li><hr>
                    <?php
                        }
                    }else {
                        echo '<li>Sem bagaens</li>';
                    }

                    ?>
                </ol>
            </td>
        </tr>
        <tr>
            <td class="tg-baqh" colspan="2">QR Code <i class="fas fa-qrcode"></i><br>
                <img src="<?php echo base_url('uploads/qr_image/' . $img_url); ?>" alt="QRCode Image">
            </td>
        </tr>
        <tr>
            <td class="tg-7geq" colspan="2">Agencia: <?php echo $dd_clinete['0']->nome_ag; ?><br>Despachante: <?php echo $dd_clinete['0']->us_nome; ?></td>
        </tr>
    </table>
    <?php
}else {
   echo '<h2 style="text-align: center">Período da consulta expirou, a viagem já ocorreu.</h2>';
}
?>

</body>

</html>