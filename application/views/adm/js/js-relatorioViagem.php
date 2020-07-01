<script>
    $(document).ready(function() {
        $('#listaCarroViagemRelatorio').DataTable({
            "language": { //Altera o idioma do DataTable para o português do Brasil
                "url": "//cdn.datatables.net/plug-ins/1.10.12/i18n/Portuguese-Brasil.json"
            },
            "order": [
                [0, "desc"]
            ],
            "ajax": {
                url: "<?= site_url('get_list_passageoro_poltronaViagem_relatorio') ?>",
                type: 'GET'
            },
        });
    });
</script>