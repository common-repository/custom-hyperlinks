<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.techmuzz.com
 * @since      1.0.0
 *
 * @package    Custom_HL
 * @subpackage Custom_HL/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Custom_HL
 * @subpackage Custom_HL/public
 * @author     TechMuzz <info@techmuzz.com>
 */
class Custom_HL_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	public static function getHost($address) {
		$parseUrl = parse_url(trim($address));
		return trim($parseUrl['host'] ? $parseUrl['host'] : array_shift(explode('/', $parseUrl['path'], 2)));
	}

	public static function appendHTML(DOMNode $parent, $source) {
		$tmpDoc = new DOMDocument();
		
		if($source != strip_tags($source)) {
			$tmpDoc->loadHTML($source);
			foreach ($tmpDoc->getElementsByTagName('body')->item(0)->childNodes as $node) {
				$node = $parent->ownerDocument->importNode($node, true);
				$parent->appendChild($node);
			}
		} else {
			$node = $parent->ownerDocument->importNode($tmpDoc->createTextNode($source));
			$parent->appendChild($node);
		}
		
		return $parent;
	}

	public function custom_hl_the_content( $content ) {
		$options = get_option($this->plugin_name);

		if($options['switch']) {
			$domains = explode("\n", $options['domains']);
			$domains = array_filter($domains); //will filter empty values
			$domains = array_map("self::getHost", $domains);

			if(!empty($domains)) {
				$element = html_entity_decode($options['element']);
				$target = $options['target'];
				$dom = new DOMDocument;
				@$dom->loadHTML($content);
				
				foreach ($dom->getElementsByTagName('a') as $anchorTag){
					$host = self::getHost($anchorTag->getAttribute('href'));
					if(!in_array($host, $domains)) {
						if ($target != "-1") $anchorTag->setAttribute('target', $target);
						self::appendHTML($anchorTag, $element);
					}
				}
				$content = $dom->saveHtml();
			}
		}
		return $content;
	}

}
