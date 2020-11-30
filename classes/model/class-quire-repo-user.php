<?php


class Quire_Repo_User extends Quire_Repo_Abstract {

	protected Quire_Repo_Agency $agency_repo;
	protected Quire_Repo_Group $group_repo;

	/**
	 * Quire_Repo_User constructor.
	 */
	public function __construct() {
		$this->agency_repo = new Quire_Repo_Agency();
		$this->group_repo  = new Quire_Repo_Group();
	}

	public function getCPT() {
		// TODO: Implement getCPT() method.
		return;
	}

	public function getItems( $query_args, $full = false ) {
		// TODO: Implement getItems() method.

		$items = [];
		$users = get_users( $query_args );
		foreach ( $users as $user ) {
			$item = $this->getItem( $user->ID, $full, $user );
			if ( $item ) {
				$items[] = $item;
			}
		}

		return $items;
	}

	public function getItem( $id, $full = false, $raw = [] ) {
		// TODO: Implement getItem() method.
		if ( ! get_userdata( $id ) ) {
			return;
		}
		$raw = empty( $raw ) ? get_userdata( $id ) : $raw;

		$user = new Quire_Data_User( $id, $raw );

		return $this->_buildItem( $user, $full );
	}

	protected function _buildItem( $user, $full ) {
		/** @var Quire_Data_User $user */
		$id = $user->getID();
		if ( ! isset( $id ) ) {
			return;
		}

		$user->setFirstName( $user->get_meta( 'first_name', true ) );
		$user->setLastName( $user->get_meta( 'last_name', true ) );
		$user->setDisplayName( $user->getRaw( 'display_name' ) );
		$user->setUserEmail( $user->getRaw( 'user_email' ) );
		$user->setUsername( $user->getRaw( 'user_nicename' ) );
		$user->setPhoneNumber( $user->get_meta( 'phone_number', true ) );
		$user->setAvatarUrl( get_avatar_url( $id ) );
		$user->setRoles( $user->getRaw( 'roles' ) );

		try {
			$groups = $user->get_meta( 'groups' );
			$user->setGroups(
				array_map(
					function ( $group ) {
						return $this->group_repo->getItem( $group['ID'] );
					},
					$groups
				)
			);

			$agency = $user->get_meta( 'agency', true );
			if($agency){
//			$user->setAgency( $this->agency_repo->getItem( $agency['ID'], $full ) );
				if ($full){
					$user->setAgency( $this->agency_repo->getItem( $agency['ID'], $full ) );
				}else{
					$user->setAgency( $agency['ID']);
				}
			}

		} catch ( Exception $e ) {
		}

		return $user;
	}

	public function createItem( $preparedItem ) {
		// TODO: Implement createItem() method.
	}

	public function updateItem( $id, $preparedItem ) {
		// TODO: Implement updateItem() method.
	}

	public function deleteItem( $id ) {
		// TODO: Implement deleteItem() method.
	}

	public function getCurrentItem( bool $full = false ) {
		$user = wp_get_current_user();
		$user = $this->getItem( $user->ID, $full );

		return $user;
	}

	public function isRole( $role, $item ) {
		if ( $item instanceof Quire_Data_User ) {
			return in_array( $role, $item->getRoles() );
		}

		return false;
	}
}