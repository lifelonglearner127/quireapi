<?php


class Quire_Autoloader {

	private string $include_path = '';

	private string $class_patterns = '/^(?:quire-)(?P<kind>[^-]+)(?P<part>(-((?!abstract|interface)[^-]*))*)(-(?P<type>abstract|interface))?$/';

	/**
	 * QuireApp_Autoloader constructor.
	 */
	public function __construct() {
		if ( function_exists( '__autoload' ) ) {
			spl_autoload_register( '__autoload' );
		}

		spl_autoload_register( array( $this, 'autoload' ) );

		$this->include_path = untrailingslashit( QUIRE_API_PLUGIN_DIR ) . '/classes';
	}

	public function autoload( $class ) {
		$class = str_replace( '_', '-', strtolower( $class ) );
		if ( preg_match( $this->class_patterns, $class, $matches, PREG_UNMATCHED_AS_NULL ) ) {
			$type = $matches['type'] ?: 'class';
			$part = $matches['part'] ?: '';
			$kind = $matches['kind'];
			$file = $this->get_file( $type, $kind, $part );

			$this->load_file( $file );
		}
	}

	private function get_file( $type, $kind, $part ) {


		$path = $this->include_path;
		if ( $type == 'interface' ) {
			$path .= '/interface';
		}
		if ( $kind == 'api' || $kind == 'data' ) {
			$path .= '/' . $kind;
		} else {
			$path .= '/model';
		}

		if ( $part ) {
			$file = "{$type}-quire-{$kind}{$part}.php";
		} else {
			$file = "{$type}-quire-{$kind}.php";
		}

		return $path . '/' . $file;
	}

	private function load_file( $path ) {
		if ( $path && is_readable( $path ) ) {
			include_once( $path );

			return true;
		}

		return false;
	}
}

new Quire_Autoloader();