<?php
/*************************************************************************************/
/*      This file is part of the "Diaporamas" Thelia 2 module.                       */
/*                                                                                   */
/*      Copyright (c) OpenStudio                                                     */
/*      email : dev@thelia.net                                                       */
/*      web : http://www.thelia.net                                                  */
/*                                                                                   */
/*      For the full copyright and license information, please view the LICENSE.txt  */
/*      file that was distributed with this source code.                             */
/*************************************************************************************/
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
            'no_diaporama' => 'There is no diaporama.',
            'no_shortcode %shortcode' => 'There is no diaporama with the shortcode [£%shortcode£].',
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
        'menu_title' => 'Diaporamas',
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
