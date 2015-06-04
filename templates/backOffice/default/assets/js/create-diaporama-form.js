$(document).ready(function () {
    $('select#diaporama_diaporama_type_id').change(loadEntities);

    loadEntities();

    function loadEntities() {
        $.getJSON(
            "{url path='/admin/module/Diaporamas/diaporama/entity_choices/'}" + $('select#diaporama_diaporama_type_id').val(),
            function (data) {
                var entitySelect = $('select#diaporama_entity_id');
                entitySelect.html('');

                for (var id in data) {
                    var opt = $('<option>');
                    opt.attr('value', id);
                    opt.append(data[id]);
                    entitySelect.append(opt);
                }

                entitySelect.children().first().attr('selected', 'selected');

                $('span#entity_label').html($('select#diaporama_diaporama_type_id option:selected').html());
            }
        );
    }
});
