<?php


abstract class Quire_Repo_Abstract {

	public function getItems( $query_args, $full = false ) {
		// TODO: Implement getItems() method.
		$query_args['post_type']   = $this->getCPT();
		$query_args['post_status'] = 'any';

		$items = [];
		$posts = get_posts( $query_args );
		foreach ( $posts as $post ) {
			$items[] = $this->getItem( $post->ID, $full, $post );
		}

		return $items;
	}

	/**
	 * @return string
	 */
	abstract public function getCPT();

	abstract public function getItem( $id, $full = false, $raw = [] );

	abstract public function createItem( $preparedItem );

	abstract public function updateItem( $id, $preparedItem );

	abstract public function deleteItem( $id );


}