<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos::encoemnda</title>
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

        .tg .tg-ggg6 {
            background-color: #ecf4ff;
            text-align: center;
            vertical-align: middle
        }

        .tg .tg-rgo3 {
            background-color: #fffc9e;
            text-align: center;
            vertical-align: middle
        }

        .tg .tg-nrix {
            text-align: center;
            vertical-align: middle
        }

        .tg .tg-v4j2 {
            font-weight: bold;
            background-color: #c0c0c0;
            text-align: center;
            vertical-align: middle
        }
    </style>
</head>

<body>
<img src="<?= base_url() ?>stylus/assets/img/logo_geral.png" class="img-responsive" alt="Calebe Turismo">
    <table class="tg">
        <tr>
            <th class="tg-ggg6" colspan="3"><span style="font-weight:bold">Remetente:</span> <?=$list_produto_usuario[0]->fk_nome_ciente_cl;?></th>
            <th class="tg-ggg6" colspan="2"><span style="font-weight:bold">Destinatário:</span> <?=$list_produto_usuario[0]->remetente_nome_enc;?></th>
        </tr>
        <tr>
            <td class="tg-cly1"><span style="font-weight:bold">RG remetente:</span> <?=$list_produto_usuario[0]->remetente_rg_enc;?></td>
            <td class="tg-cly1" colspan="1"><span style="font-weight:bold">Local da retirada:</span> <?=$list_produto_usuario[0]->remetente_local_recebe_enc;?></td>
            <td class="tg-cly1" colspan="1"><span style="font-weight:bold">Data:</span> <?=date("d/m/Y", strtotime($list_produto_usuario[0]->data_cadastro_enc));?></td>
            <td class="tg-cly1" colspan="2"><span style="font-weight:bold">Telefone:</span> <?=$list_produto_usuario[0]->remetente_telefone_enc;?></td>
        </tr>
        <tr>
            <td class="tg-rgo3">Descrição:</td>
            <td class="tg-rgo3">Cód.:</td>
            <td class="tg-rgo3">Valor:</td>
            <td class="tg-rgo3">Qtd.:</td>
        </tr>
        <?php

        $valor_total = 0;
        $qtd_total = 0;

        foreach ($list_produto_usuario as $value) {
        ?>
            <tr>
                <td class="tg-nrix"><?=$value->descricao_peca_enc;?></td>
                <td class="tg-nrix"><?=$value->codigo_produto_enc;?></td>
                <td class="tg-nrix"><?=number_format($value->valor_produto_enc, 2, ',', '.')?></td>
                <td class="tg-nrix"><?=$value->qtd_produto_enc;?></td>
            </tr>
        <?php
        $valor_total += $value->valor_produto_enc;
        $qtd_total += $value->qtd_produto_enc;
        }
        ?>

        <tr>
            <td class="tg-v4j2" colspan="2">Total dos produtos:</td>
            <td class="tg-v4j2" colspan="1">R$ <?=number_format($valor_total, 2, ',', '.');?></td>
            <td class="tg-v4j2" colspan="2"><?=$qtd_total;?></td>
        </tr>
    </table>
</body>

</html>