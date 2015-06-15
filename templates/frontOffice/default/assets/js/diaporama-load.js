$(document).ready(function () {
    $('div.description').each(function (index) {
        var element = $(this);
        $.post(
            "{url path='/admin/module/Diaporamas/diaporama/replace_shortcodes'}",
            {
                description: element.html()
            },
            function (data) {
                element.html(data);
            }
        );
    });
});
