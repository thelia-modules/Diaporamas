jQuery(document).ready(function () {
    // The diaporama_entity_selector variable depends on what is displaying diaporamas and is previously defined.
    jQuery(diaporama_entity_selector).each(function (index) {
        var element = jQuery(this);
        jQuery.post(
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
