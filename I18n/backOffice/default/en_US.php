<?php
return array(
    'diaporama' => array(
        'create' => array(
            'dialog_title' => 'Create a diaporama',
            'title' => 'Title',
            'title.placeholder' => 'The Diaporama Title',
            'shortcode' => 'Shortcode',
            'shortcode.placeholder' => 'The Diaporama Shortcode',
            'shortcode.regex_fail' => 'The shortcode has to contain between 1 and 32 letters, digits, underscores ("_") or hyphens("-")',
            'diaporama_type' => 'Diaporama for',
            'entity_id' => 'Entity',
            'invalid_entity' => 'Invalid %entity',
        ),
        'read' => array(
            'id' => 'ID',
            'title' => 'Title',
            'shortcode' => 'Shortcode',
            'diaporama_type' => 'Diaporama for',
            'entity' => 'Diaporama subject',
            'see' => 'See the diaporama',
            'edit' => 'Edit the diaporama',
            'delete' => 'Delete the diaporama',
            'no_diaporama' => 'There is no diaporama.'
        ),
        'update' => array(
            'title' => 'Diaporama edit',
            'general' => array(
                'title' => 'General',
                'timestamp %created_at %updated_at' => 'Diaporama created on %created_at. Last modification: %updated_at',
            ),
            'images' => array(
                'title' => 'Images',
            ),
        ),
        'delete' => array(
            'content' => 'Do you really want to delete this diaporama?',
            'title' => 'Delete a diaporama',
            'invalid_diaporama %diaporama_id' => 'A diaporama whose ID is %diaporama_id does not exist.',
        ),
    ),

    'diaporama_images' => array(
        'create' => array(
            'dialog_title' => 'Create a diaporama image',
            'title' => 'Title',
            'title.placeholder' => 'The image Title',
        ),
        'read' => array(
        ),
        'update' => array(
        ),
        'delete' => array(
        ),
    ),

    'Or' => 'Or',
);
