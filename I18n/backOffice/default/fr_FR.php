<?php
return array(
    'diaporama' => array(
        'create' => array(
            'dialog_title' => 'Créer un diaporama',
            'title' => 'Titre',
            'title.placeholder' => 'Titre du diaporama',
            'shortcode' => 'Shortcode',
            'shortcode.placeholder' => 'Shortcode',
            'diaporama_type' => 'Diaporama pour',
            'entity_id' => 'Entité',
            'invalid_entity' => '%entity non valide',
        ),
        'read' => array(
            'id' => 'ID',
            'title' => 'Titre',
            'shortcode' => 'Shortcode',
            'diaporama_type' => 'Diaporama pour',
            'entity' => 'Sujet du diaporama',
            'see' => 'Voir le diaporama',
            'edit' => 'Modifier le diaporama',
            'delete' => 'Supprimer le diaporama',
            'no_diaporama' => 'Il n\'y a aucun diaporama.'
        ),
        'update' => array(
            'title' => 'Modification de diaporama',
            'general' => array(
                'title' => 'Général',
                'timestamp %created_at %updated_at' => 'Diaporama créé le %created_at. Dernière modification : %updated_at',
            ),
            'images' => array(
                'title' => 'Images',
            ),
        ),
        'delete' => array(
            'content' => 'Voulez-vous vraiment supprimer ce diaporama ?',
            'title' => 'Supprimer un diaporama',
            'invalid_diaporama %diaporama_id' => 'Il n\'existe pas de diaporama dont l\'identifiant est %diaporama_id.',
        ),
    ),

    // Diaporama types
    'diaporama_type' => array(
        'product' => 'produit',
        'category' => 'rubrique',
        'brand' => 'marque',
        'folder' => 'dossier',
        'content' => 'contenu',
    ),


);
