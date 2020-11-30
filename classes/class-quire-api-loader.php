<?php


class Quire_API_Loader {

	private $apis = [];

	/**
	 * QuireApp_API_Register constructor.
	 */
	public function __construct() {
		$this->_init();
	}

	private function _init() {
		if ( ! class_exists( 'WP_REST_Server' ) ) {
			return;
		}

		add_action( 'rest_api_init', [ $this, 'createAPIs' ] );
	}

	public function createAPIs() {
		$apis = $this->getAPIs();
		foreach ( $apis as $key => $api ) {
			if ( is_string( $api ) ) {
				$this->apis[ $key ] = new $api( $key );
			} else {
				$this->apis[ $key ] = $api;
			}

			$this->apis[ $key ]->register_routes();
		}
	}

	protected function getAPIs() {
		return [
			'agencies'    => 'Quire_API_Agency',
			'assignments' => 'Quire_API_Assignment',
			'courses'     => 'Quire_API_Course',
			'groups'      => 'Quire_API_Group',
			'users'       => 'Quire_API_User',
			'caregivers'  => 'Quire_API_Caregiver',
		];
	}

}

new Quire_API_Loader();