-- Creates diaporama types
INSERT INTO `diaporama_type` (`id`, `code`, `path`) VALUES
	(1, 'product', '/admin/products/update?product_id=%id'),
	(2, 'category', '/admin/catalog/?catagory_id=%id'),
	(3, 'brand', '/admin/brand/update/%id'),
	(4, 'folder', '/admin/folders?parent=%id'),
	(5, 'content', '/admin/content/update/%id');
INSERT INTO `diaporama_type_i18n` (`id`, `locale`, `title`) VALUES
	(1, 'en_US', 'product'),
	(1, 'fr_FR', 'produit'),
	(2, 'en_US', 'category'),
	(2, 'fr_FR', 'rubrique'),
	(3, 'en_US', 'brand'),
	(3, 'fr_FR', 'marque'),
	(4, 'en_US', 'folder'),
	(4, 'fr_FR', 'dossier'),
	(5, 'en_US', 'content'),
	(5, 'fr_FR', 'contenu');
