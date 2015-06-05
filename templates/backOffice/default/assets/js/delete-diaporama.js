$(function() {
    $('a.diaporama-delete').click(function(ev) {
        $('#diaporama_delete_id').val($(this).data('id'));
    });
});
