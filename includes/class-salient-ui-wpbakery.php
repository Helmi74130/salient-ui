<?php

/**
 * Gestion de l'intégration avec WPBakery Page Builder
 * Charge et initialise tous les éléments personnalisés
 *
 * @package SalientUI
 * @since 1.0.0
 */

// Si ce fichier est appelé directement, on arrête l'exécution
if (! defined('ABSPATH')) {
	exit;
}

/**
 * Class Salient_UI_WPBakery
 *
 * Pattern Singleton pour garantir une seule instance de la classe
 */
class Salient_UI_WPBakery
{

	/**
	 * Instance unique de la classe (Singleton)
	 *
	 * @var Salient_UI_WPBakery|null
	 */
	private static $instance = null;

	/**
	 * Constructeur privé pour empêcher l'instanciation directe
	 * Appelé uniquement via get_instance()
	 */
	private function __construct()
	{
		$this->load_elements();
	}

	/**
	 * Récupérer l'instance unique de la classe (Singleton)
	 *
	 * @return Salient_UI_WPBakery Instance unique de la classe
	 */
	public static function get_instance()
	{
		if (null === self::$instance) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Charger tous les éléments WPBakery personnalisés
	 * Liste extensible pour ajouter facilement de nouveaux composants
	 */
	private function load_elements()
	{
		salient_ui_log('WPBakery::load_elements() appelé');

		// Liste des éléments à charger
		// Pour ajouter un nouvel élément, il suffit d'ajouter le nom de la classe ici
		$elements = array(
			'Salient_UI_Button',          // Élément Button
			'Salient_UI_Card',            // Élément Card
			'Salient_UI_Prism_Button_V2', // Élément Prism Button v2
			'Salient_UI_Word_Rotator_Loader', // Élément Word Rotator Loader
			'Salient_UI_Orbital_Glow_Button', // Élément Orbital Glow Button
			'Salient_UI_Realism_Button', // Élément Realism Button
			'Salient_UI_Sparkle_Glow_Button', // Élément Sparkle Glow Button
			'Salient_UI_Marquee_Button', // Élément Marquee Button
			'Salient_UI_Circular_Text_Button', // Élément Circular Text Button
			'Salient_UI_Glitch_Button', // Élément Glitch Button
			'Salient_UI_Arrow_Icon_Button', // Élément Arrow Icon Button
			'Salient_UI_Dual_Text_Button', // Élément Dual Text Button
			'Salient_UI_Particle_Glow_Button', // Élément Particle Glow Button
			'Salient_UI_Blur_Reveal', // Élément Blur Reveal
			'Salient_UI_Countdown', // Élément Countdown
			'Salient_UI_Read_More', // Élément Read More
			'Salient_UI_Scramble_Text', // Élément Scramble Text
			'Salient_UI_Split_Text_Animation', // Élément Split Text Animation
			'Salient_UI_Flair_Button', // Élément Flair Button
			'Salient_UI_Text_Shimmer', // Élément Text Shimmer
			'Salient_UI_Blurry_Button', // Élément Blurry Button
			'Salient_UI_Stretchy_Button', // Élément Stretchy Button
			'Salient_UI_Arrow_Button_V5', // Élément Arrow Button v5
			'Salient_UI_Squeezy_Radius_Button', // Élément Squeezy Radius Button
		);

		salient_ui_log('Nombre d\'éléments à charger : ' . count($elements));

		// Instancier chaque élément
		foreach ($elements as $element_class) {
			salient_ui_log("Tentative de chargement de la classe : {$element_class}");

			// Vérifier que la classe existe avant de l'instancier
			if (class_exists($element_class)) {
				// Instancier l'élément
				// Le constructeur de chaque élément s'occupe de l'enregistrement
				$element = new $element_class();
				salient_ui_log("✓ Classe {$element_class} instanciée avec succès");
			} else {
				salient_ui_log("✗ ERREUR : La classe {$element_class} n'existe pas");
				// Log d'erreur si la classe n'existe pas (en mode debug uniquement)
				if (defined('WP_DEBUG') && WP_DEBUG) {
					error_log(
						sprintf(
							'SalientUI: La classe %s n\'existe pas.',
							$element_class
						)
					);
				}
			}
		}

		salient_ui_log('Chargement des éléments terminé');
	}

	/**
	 * Empêcher le clonage de l'instance (Singleton)
	 */
	private function __clone() {}

	/**
	 * Empêcher la désérialisation de l'instance (Singleton)
	 */
	public function __wakeup()
	{
		throw new Exception('Cannot unserialize singleton');
	}
}