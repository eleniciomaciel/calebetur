<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-ticket-bagagem</title>
    <style type="text/css">
        .tg {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
        }

        .tg td {
            font-family: Arial, sans-serif;
            font-size: 14px;
            padding: 10px 5px;
            border-style: solid;
            border-width: 1px;
            overflow: hidden;
            word-break: normal;
            border-color: black;
        }

        .tg th {
            font-family: Arial, sans-serif;
            font-size: 14px;
            font-weight: normal;
            padding: 10px 5px;
            border-style: solid;
            border-width: 1px;
            overflow: hidden;
            word-break: normal;
            border-color: black;
        }

        .tg .tg-cly1 {
            text-align: left;
            vertical-align: middle
        }

        .tg .tg-abx8 {
            font-weight: bold;
            background-color: #c0c0c0;
            text-align: left;
            vertical-align: top
        }

        .tg .tg-wa1i {
            font-weight: bold;
            text-align: center;
            vertical-align: middle
        }

        .tg .tg-nrix {
            text-align: center;
            vertical-align: middle
        }

        .tg .tg-nreg {
            font-weight: bold;
            background-color: #cbcefb;
            text-align: center;
            vertical-align: middle
        }

        .tg .tg-bv7r {
            background-color: #dae8fc;
            text-align: left;
            vertical-align: middle
        }

        .tg .tg-mums {
            font-weight: bold;
            background-color: #ffffff;
            border-color: #000000;
            text-align: center;
            vertical-align: top
        }
    </style>
</head>

<body>

    <table class="tg">
        <tr>
            <th class="tg-nrix">Logo:</th>
            <th class="tg-nrix"><span style="font-weight:bold">Destinatário: </span><br><?php echo $dd_encomendas['0']->fk_nome_ciente_cl; ?></th>
            <th class="tg-nrix"><span style="font-weight:bold">Remetente: </span><br><?php echo $dd_encomendas['0']->remetente_nome_enc; ?></th>
            <th class="tg-nrix"><span style="font-weight:bold">Data:</span> <?php echo date("d/m/Y H:i", strtotime($dd_encomendas['0']->data_cadastro_enc)); ?></th>
            <th class="tg-nrix"><span style="font-weight:bold">Telefone:</span> <br><?php echo $dd_encomendas['0']->remetente_telefone_enc; ?></th>
        </tr>

        <tr>
            <td class="tg-nreg">Status:</td>
            <td class="tg-nreg">Descrição:</td>
            <td class="tg-nreg">Cód:</td>
            <td class="tg-nreg">Qtd:</td>
            <td class="tg-nreg">Valor:</td>
        </tr>
        <?php

        $total_valor2 = 0;
        $total_qtd2 = 0;

        foreach ($dd_encomendas as $key) {

        ?>
        <tr>
            <td class="tg-cly1"><?php echo $key->status_encomenda_enc;?></td>
            <td class="tg-cly1"><?php echo $key->descricao_peca_enc;?></td>
            <td class="tg-cly1"><?php echo $key->codigo_produto_enc;?></td>
            <td class="tg-cly1"><?php echo $key->qtd_produto_enc;?></td>
            <td class="tg-cly1"><?php echo $key->valor_produto_enc;?></td>
        </tr>
        <?php

            $total_valor2 += $key->valor_produto_enc;
            $total_qtd2 += $key->qtd_produto_enc;
        }
        ?>

        <tr>
            <td class="tg-wa1i" colspan="3">Total:</td>
            <td class="tg-bv7r"><?php echo $total_qtd2;?></td>
            <td class="tg-bv7r">R$ <?php echo number_format($total_valor2, 2, ',', '.');?></td>
        </tr>

        <tr>
            <td class="tg-mums" colspan="5">QrCode:<br>
            <img src="<?php echo base_url('uploads/qr_image/' . $img_url_qd); ?>" alt="QRCode Image">
        </td>
        </tr>
        <tr>
            <td class="tg-abx8" colspan="5">Observação: <?php echo $dd_encomendas['0']->observacao_cliente_encomenda_enc; ?></td>
        </tr>
        
    </table>
</body>

</html>