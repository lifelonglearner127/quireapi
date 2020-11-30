<?php


class Quire_Repo_Group extends Quire_Repo_Abstract {

	/**
	 * Quire_Repo_Group constructor.
	 */
	public function __construct() {
	}

	public function getCPT() {
		// TODO: Implement getCPT() method.
		return GROUP_CPT;
	}

	public function getItem( $id, $full = false, $raw = [] ) {
		// TODO: Implement getItem() method.
		if ( get_post_type( $id ) != $this->getCPT() ) {
			return;
		}
		$raw = empty( $raw ) ? get_post( $id ) : $raw;

		$group = new Quire_Data_Group( $id, $raw );
		$group->setSlug( $group->getRaw( 'post_name' ) );
		$group->setName( $group->getRaw( 'post_title' ) );
		$group->setDateCreated( $group->getRaw( 'post_date' ) );
		$group->setExcerpt( $group->getRaw( 'post_excerpt' ) );

		$featured_img = wp_get_attachment_url( get_post_thumbnail_id( $id ) );
		if ( ! $featured_img ) {
			$featured_img = 'http://api.quireapp.local/wp-content/uploads/2020/08/employee.png';
		}
		$group->setFeaturedImage( $featured_img );
		$group->setGroupType( $this->getGroupType( $id ) );
		$group->setCourses( $group->get_meta( 'courses' ) );

		if ( $full ) {
			$group->setUsers( $group->get_meta( 'users' ) );
		}

		return $group;
	}

	public function getGroupType( $id ) {
		$types = wp_get_post_terms( $id, 'group_type', [ 'fields' => 'slugs' ] );

		return $types[0];
	}

	public function getItemsByType( $type, $query_args, $full ) {
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => 'group_type',
				'field'    => 'slug',
				'terms'    => $type,
			)
		);

		return $this->getItems( $query_args, $full );
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
}