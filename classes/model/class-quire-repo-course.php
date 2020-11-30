<?php


class Quire_Repo_Course extends Quire_Repo_Abstract {

	/**
	 * Quire_Repo_Course constructor.
	 */
	public function __construct() {
	}

	public function getCPT() {
		// TODO: Implement getCPT() method.
		return COURSE_CPT;
	}

	public function getItem( $id, $full = false, $raw = [] ) {
		// TODO: Implement getItem() method.

		if ( get_post_type( $id ) != $this->getCPT() ) {
			return;
		}
		$raw = empty( $raw ) ? get_post( $id ) : $raw;

		$course    = new Quire_Data_Course( $id, $raw );
		$lp_course = new LP_Course( $id );

		$course->setTitle( $course->getRaw( 'post_title' ) );
		$course->setSlug( $course->getRaw( 'post_name' ) );
		$course->setExcerpt( $course->getRaw( 'post_excerpt' ) );

		$featured_img = wp_get_attachment_url( get_post_thumbnail_id( $id ) );
		$course->setFeaturedImage( $featured_img );

		$course->setDuration( $course->get_meta( '_lp_duration', true ) );
		$course->setItemCount( $course->get_meta( 'count_items', true ) );
		$course->setEnrollRequired( $course->get_meta( '_lp_required_enroll', true ) );
		$course->setPassingCondition( $course->get_meta( '_lp_passing_condition', true ) );
		$course->setStudents( $course->get_meta( '_lp_students', true ) );

		if ( $full ) {
			$course->setContent( $course->getRaw( 'post_content' ) );
			$course->setSections( $lp_course->get_curriculum_raw() );
		} else {
		}

		return $course;
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