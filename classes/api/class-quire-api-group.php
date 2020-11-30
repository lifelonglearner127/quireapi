<?php


class Quire_API_Group extends Quire_API_Abstract implements Quire_API_Group_Interface {

	protected Quire_Repo_Group $base_repo;
	protected Quire_Repo_User $user_repo;

	public function __construct( $rest_base = 'groups' ) {
		parent::__construct( $rest_base );
		$this->base_repo = new Quire_Repo_Group();
		$this->user_repo = new Quire_Repo_User();
	}

	protected function getRoutes() {
		// TODO: Implement getRoutes() method.
		return [
			'(?P<type>course|caregiver)' => array(
				array(
					'methods'             => WP_REST_Server::READABLE,
					'callback'            => array( $this, 'get_items' ),
					'permission_callback' => array( $this, 'get_items_permissions_check' ),
					'args'                => $this->get_collection_params(),
				)
			),
			'(?P<id>[\d]+)'              => array(
				'args'   => array(
					'id' => array(
						'description' => __( 'Unique identifier for the group.' ),
						'type'        => 'integer',
					),
				),
				array(
					'methods'             => WP_REST_Server::READABLE,
					'callback'            => array( $this, 'get_item' ),
					'permission_callback' => array( $this, 'get_item_permissions_check' )
				),
				'schema' => array( $this, 'get_public_item_schema' ),
			),
			'type/(?P<id>[\d]+)'         => array(
				'args'   => array(
					'id' => array(
						'description' => __( 'Unique identifier for the group.' ),
						'type'        => 'integer',
					),
				),
				array(
					'methods'             => WP_REST_Server::READABLE,
					'callback'            => array( $this, 'get_group_type' ),
					'permission_callback' => array( $this, 'get_group_type_permissions_check' )
				),
				'schema' => array( $this, 'get_public_item_schema' ),
			)
		];
	}

	public function get_items_permissions_check( $request ) {
		$current_user = $this->user_repo->getCurrentItem();
		if ( ! $current_user ) {
			return new WP_Error(
				'rest_user_no_login',
				__( 'User not logged in.' ),
				array( 'status' => 404 )
			);
		}

		return true;
	}

	public function get_items( $request ) {
		$registered = $this->get_collection_params();

		$parameter_mappings = array();

		$prepared_args = array();

		foreach ( $parameter_mappings as $api_param => $wp_param ) {
			if ( isset( $registered[ $api_param ], $request[ $api_param ] ) ) {
				$prepared_args[ $wp_param ] = $request[ $api_param ];
			}
		}

		$type = '';
		if ( isset( $registered['type'] ) ) {
			$type_possibles = array(
				'course'    => GROUP_COURSE,
				'caregiver' => GROUP_CAREGIVER
			);
			$type           = $type_possibles[ $request['type'] ];
		}

		$groups       = [];
		$full         = true;
		$current_user = $this->user_repo->getCurrentItem( true );
		if ( $this->user_repo->isRole( CAREGIVER_ROLE, $current_user ) ) {
			$groups = array_map( function ( $group ) {
				return $group->getID();
			}, $current_user->getGroups() );

			if ( $type == GROUP_CAREGIVER ) {
				$full = false;
			}
		} elseif ( $this->user_repo->isRole( AGENCY_ADMIN_ROLE, $current_user ) ) {
			/** @var Quire_Data_Agency $agency */
			$agency = $current_user->getAgency();
			$groups = array_map( function ( $group ) {
				return $group['ID'];
			}, $agency->getGroups() );
		}

		$query_args = array( 'include' => $groups );
		$groups     = $this->base_repo->getItemsByType( $type, $query_args, $full );

		$data = array();
		/** @var Quire_Data_Assignment $group */
		foreach ( $groups as $group ) {
			$data[] = $this->prepare_item_for_response( $group, $request );
		}

		$response = rest_ensure_response( $data );

		return $response;
	}

	public function get_item_permissions_check( $request ) {
		/** @var Quire_Data_User $current_user */
		$current_user = $this->user_repo->getCurrentItem( true );
		if ( ! $current_user ) {
			return new WP_Error(
				'rest_user_no_login',
				__( 'User not logged in.' ),
				array( 'status' => 404 )
			);
		}

		$group_id = $request['id'];
		/** @var Quire_Data_Agency $agency */
		$agency = $current_user->getAgency();
		if ( ! $agency || ! in_array( $group_id, array_column( $agency->getGroups(), 'ID' ) ) ) {
			return new WP_Error(
				'rest_user_no_permission',
				__( 'User have not permission to a group!' ),
				array( 'status' => 404 )
			);
		}

		$group_type = $this->base_repo->getGroupType( $request['id'] );
		if ( $this->user_repo->isRole( CAREGIVER_ROLE, $current_user ) && $group_type == GROUP_CAREGIVERS ) {
			$groups = array_map( function ( $group ) {
				return $group->getID();
			}, $current_user->getGroups() );
			if ( ! in_array( $group_id, $groups ) ) {
				return new WP_Error(
					'rest_user_no_permission',
					__( 'User have not permission to a group!' ),
					array( 'status' => 404 )
				);
			}
		}

		return true;
	}

	public function get_item( $request ) {
		$current_user = $this->user_repo->getCurrentItem();
		$group_type   = $this->base_repo->getGroupType( $request['id'] );

		$group = false;
		if ( $this->user_repo->isRole( CAREGIVER_ROLE, $current_user ) && $group_type == GROUP_CAREGIVERS ) {
			$group = $this->base_repo->getItem( $request['id'], false );
		} else if ( $this->user_repo->isRole( AGENCY_ADMIN_ROLE, $current_user ) ) {
			$group = $this->base_repo->getItem( $request['id'], true );
		}

		if ( ! $group ) {
			return new WP_Error(
				'rest_group_invalid_id',
				__( 'Invalid group ID.' ),
				array( 'status' => 404 )
			);
		}

		$data     = $this->prepare_item_for_response( $group, $request );
		$response = rest_ensure_response( $data );

		return $response;

	}

	public function get_group_type_permissions_check( $request ) {
		return $this->get_item_permissions_check( $request );
	}

	public function get_group_type( $request ) {
		$group_type = $this->base_repo->getGroupType( $request['id'] );

		if ( ! $group_type ) {
			return new WP_Error(
				'rest_group_no_type',
				__( 'Group have not type.' ),
				array( 'status' => 404 )
			);
		}

		$data     = $this->prepare_item_for_response( $group_type, $request );
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
		return array(
			'type' => array(
				'default'     => 'course',
				'description' => __( 'Group type.' ),
				'enum'        => array(
					'course',
					'caregiver'
				),
				'type'        => 'string',
			)
		);
	}

}