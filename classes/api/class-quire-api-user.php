<?php


class Quire_API_User extends Quire_API_Abstract implements Quire_API_User_Interface {

	protected Quire_Repo_User $base_repo;

	public function __construct( $rest_base = 'users' ) {
		parent::__construct( $rest_base );
		$this->base_repo = new Quire_Repo_User();
	}

	protected function getRoutes() {
		// TODO: Implement getRoutes() method.
		return [
			array(
				array(
					'methods'             => WP_REST_Server::READABLE,
					'callback'            => array( $this, 'get_items' ),
					'permission_callback' => array( $this, 'get_items_permissions_check' ),
					'args'                => $this->get_collection_params(),
				)
			),
			'(?P<id>[\d]+)' => array(
				array(
					'methods'             => WP_REST_Server::READABLE,
					'callback'            => array( $this, 'get_item' ),
					'permission_callback' => array( $this, 'get_item_permissions_check' ),
					'args'                => array(
						'id' => array(
							'description' => __( 'Unique identifier for the user.' ),
							'type'        => 'integer',
						),
					),
				),
				'schema' => array( $this, 'get_public_item_schema' ),
			)
		];
	}

	public function get_items_permissions_check( $request ) {
		return $this->get_item_permissions_check( $request );
	}

	public function get_items( $request ) {
		$users        = array();
		$current_user = $this->base_repo->getCurrentItem( true );
		if ( $this->base_repo->isRole( AGENCY_ADMIN_ROLE, $current_user ) ) {
			/** @var Quire_Data_Agency $agency */
			$agency = $current_user->getAgency();
			$users  = array_map( function ( $user_id ) {
				return $user_id;
			}, $agency->getUsers() );
			$users  = $this->base_repo->getItems( array( 'include' => $users ), true );
		} elseif ( $this->base_repo->isRole( ADMIN_ROLE, $current_user ) ) {
			$users = $this->base_repo->getItems( array(), true );
		}

		$data = array();
		foreach ( $users as $agency ) {
			$data[] = $this->prepare_item_for_response( $agency, $request );
		}

		$response = rest_ensure_response( $data );

		return $response;
	}

	public function get_item_permissions_check( $request ) {
		$current_user = $this->base_repo->getCurrentItem();
		if ( ! $current_user ) {
			return new WP_Error(
				'rest_user_no_login',
				__( 'User not logged in.' ),
				array( 'status' => 404 )
			);
		}

		if ( ! $this->base_repo->isRole( ADMIN_ROLE, $current_user )
		     && ! $this->base_repo->isRole( AGENCY_ADMIN_ROLE, $current_user ) ) {
			return new WP_Error(
				'rest_user_no_permission',
				__( 'User have not permission to a user!' ),
				array( 'status' => 404 )
			);
		}

		return true;
	}

	public function get_item( $request ) {
		$current_user = $this->base_repo->getCurrentItem( true );

		$user = false;
		if ( $this->base_repo->isRole( AGENCY_ADMIN_ROLE, $current_user ) ) {
			$agency = $current_user->getAgency();
			$users  = array_map( function ( $user_id ) {
				return $user_id;
			}, $agency->getUsers() );
			if (in_array($request['id'], $users)){
				$user = $this->base_repo->getItem( $request['id'], true );
			}
		} elseif ( $this->base_repo->isRole( ADMIN_ROLE, $current_user ) ) {
			$user = $this->base_repo->getItem( $request['id'], true );
		}

		if ( ! $user ) {
			return new WP_Error(
				'rest_user_invalid_id',
				__( 'Invalid user ID.' ),
				array( 'status' => 404 )
			);
		}

		$data     = $this->prepare_item_for_response( $user, $request );
		$response = rest_ensure_response( $data );

		return $response;
	}

	public function prepare_item_for_response( $item, $request ) {
		return $item; // TODO: Change the autogenerated stub
	}

	public function get_item_schema() {
		return parent::get_item_schema(); // TODO: Change the autogenerated stub
	}

	public function get_collection_params() {
		return array(); // TODO: Change the autogenerated stub
	}
}