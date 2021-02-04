
$(function () {
    datatableInit();
})

//Inicializar Datatable
var datatableInit = function () {
    var table = $('#datatable-default');
    var url_lista = table.data('list');
    var url_delete = table.data('delete');
    var url_single = table.data('single');
    var cols = table.data('cols');

    var DataTable = table.DataTable({
        "order": [[0, "desc"]],
        "language": {
            "lengthMenu": "_MENU_ registros por página",
            "zeroRecords": "Nenhuma informação cadastrada",
            "info": "Exibindo _PAGE_ de _PAGES_",
            "infoEmpty": "Nenhum registro encontrado",
            "infoFiltered": "(Filtrado de _MAX_ do total de registros)",
            "sSearch": "Pesquisar",
            "paginate": { "previous": "Anterior", "next": "Próxima" }
        },
        ajax: {
            "url": url_lista,
        },
        columns: cols,
        columnDefs: [{
            "targets": -1,
            "render": function (xhr, type, row, meta) {
                return  "<a href='" + url_single + '/' + row['id'] + "' class=\"on-default \">\n" +
                "<i class='far fa-eye'></i>" +
                "</a>"
                +
               "<a href='" + url_delete + '/' + row['id'] + "' class=\"on-default remove-row\">\n" +
                    "<i class='far fa-trash-alt'></i>" +
                    "</a>" 
                   
                    ;
            }
        }]
    });

    $(document).on('click', '.remove-row', function (e) {
        e.preventDefault();
        if (confirm("Deseja realmente apagar esse registro?")) {
            //Remover a linha
            DataTable
                .row($(this).parents('tr'))
                .remove()
                .draw();
            var href = $(this).attr('href');

            $.ajax({
                url: href,
                type: 'get',
                success: function (response) {
                   alert('Sucesso')
                },
                error: function () {
                    alert('Erro')
                },
                complete: function () {
                    DataTable.ajax.reload();
                }
            });
            return true;
        } else {
            e.preventDefault();
            return false;
        }
    });
};