CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adress` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` int(11) DEFAULT NULL,
  `commerce_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commerce_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id`, `name`, `adress`, `city`, `email`, `phone`, `commerce_name`, `commerce_type`, `photo`) VALUES
(1, 'Jean', '54 Avenue des Champs-Elysées', 'Paris', 'zzz@zzz', 987456321, 'Primeurs un autre jour !', 'Primeurs', 'primeur_625b4651ae8b9.jpg'),
(3, 'lol', '41 Rue  de l\'Université', 'Paris', 'erty@erty', 123654789, 'Bain de boucherie', 'Boucherie', 'boucherie_625b58e47801c.jpg'),
(4, 'kill', '12 Boulevard de la Madelaine', 'Paris', 'pp@pp', 7, 'Poisson of beach', 'Poissonnerie', 'poissoneriepoissonerie_625b5eff9d0b5.jpg'),
(5, 'ddd', '7 Rue de Lesdiguières', 'Paris', 'ddd@ddd', 147852369, 'Mon épicerie Paris', 'tout_produits', 'epicerie_625c85982f2c8.jpg'),
(6, 'yyyy', '33 Rue Linné', 'Paris', 'ppp@ppp', 257896413, 'Rapid\'Market', 'tout_produits', 'rapid_market_625c87df205f7.jpg'),
(7, 'zzz', '16 Rue de Belzunce', 'Paris', 'zzz@zzz', 369874521, 'les FroisMages', 'Produits_divers', 'fromage_625c8b71c3246.jpg'),
(8, 'ducrasse', '8 Rue Scribe', 'Paris', 'duc@duc', 478523619, 'Boucher Père Ducrasse', 'Boucherie', 'pere_ducrasse_625c8d3f12b4e.jpg'),
(9, 'nnn', '15 Rue Raymond Losserand', 'Paris', 'nnn@nnn', 875369412, 'Fruit d\'homme!', 'Primeurs', 'legumes_625c933ca95ec.jpg');