<?php


class Quire_Repo_Agency extends Quire_Repo_Abstract {

	/**
	 * Quire_Repo_Agency constructor.
	 */
	public function __construct() {
	}

	public function getCPT() {
		// TODO: Implement getCPT() method.
		return AGENCY_CPT;
	}

	public function getItem( $id, $full = false, $raw = [] ) {
		// TODO: Implement getItem() method.

		if ( get_post_type( $id ) != $this->getCPT() ) {
			return;
		}
		$raw = empty( $raw ) ? get_post( $id ) : $raw;

		$agency = new Quire_Data_Agency( $id, $raw );
		$agency->setTitle( $agency->getRaw( 'post_title' ) );
		$agency->setSlug( $agency->getRaw( 'post_name' ) );

		$agency->setActive( $agency->get_meta( 'active', true ) );
		if ( $full ) {
			$agency->setSubscription( $agency->get_meta( 'subscription', true ) );
			$agency->setAdministrators( $agency->get_meta( 'administrators' ) );
			$agency->setGroups( $agency->get_meta( 'groups' ) );
			$agency->setCaregivers(
				array_map(
					function ( $caregiver ) {
						return absint( $caregiver['ID'] );
					},
					$agency->get_meta( 'caregivers' )
				)
			);
			$agency->setUsers(
				array_map(
					function ( $user ) {
						return absint( $user['ID'] );
					},
					$agency->get_meta( 'users' )
				)
			);
			$agency->setOrders(
				array_map(
					function ( $order ) {
						return absint( $order['ID'] );
					},
					$agency->get_meta( 'orders' )
				)
			);
		}

		return $agency;
	}

	public function updateItem( $id, $preparedItem ) {
		// TODO: Implement updateItem() method.

	}

	public function createItem( $preparedItem ) {
		// TODO: Implement createItem() method.
	}

	public function deleteItem( $id ) {
		// TODO: Implement deleteItem() method.
	}

	public function getItemsByUser( $user ) {
		if ( $user instanceof WP_User or $user instanceof Quire_Data_User ) {
			$user = $user->ID;
		} elseif ( gettype( $user ) !== 'integer' ) {
			return;
		}
		$query_args = [
			'meta_query' => [
				'relation'     => 'AND',
				'users_clause' => [
					'key'     => 'users',
					'value'   => [ $user ],
					'compare' => 'IN',
				],
			],
		];
		$result     = $this->getItems( $query_args, false );

		return ! empty( $result ) ? $result : false;
	}

	public function getItemsBy( $admin_id, $caregiver_id ) {
		$query_args = [
			'meta_query' => [
				'relation'              => 'AND',
				'administrators_clause' => [
					'key'     => 'administrators',
					'value'   => [ $admin_id ],
					'compare' => 'IN',
				],
				'caregiver_clause'      => [
					'key'     => 'caregivers',
					'value'   => [ $caregiver_id ],
					'compare' => 'IN',
				],
			]
		];
		$result     = $this->getItems( $query_args, false );

		return ! empty( $result ) ? $result : false;
	}
}