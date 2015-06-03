-- Creates diaporama types
INSERT INTO `diaporama_type` (`id`, `code`) VALUES
	(1, 'product'),
	(2, 'category'),
	(3, 'brand'),
	(4, 'folder'),
	(5, 'content');
INSERT INTO `diaporama_type_i18n` (`id`, `locale`, `title`) VALUES
	(1, 'en_US', 'product'),
	(1, 'fr_FR', 'produit'),
	(2, 'en_US', 'category'),
	(2, 'fr_FR', 'catégorie'),
	(3, 'en_US', 'brand'),
	(3, 'fr_FR', 'marque'),
	(4, 'en_US', 'folder'),
	(4, 'fr_FR', 'dossier'),
	(5, 'en_US', 'content'),
	(5, 'fr_FR', 'contenu');
