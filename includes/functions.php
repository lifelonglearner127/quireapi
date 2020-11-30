<?php

function quire_post_insert_hook( $order_id, $order, $update ) {

	if ( $order->post_type === LP_ORDER_CPT && $order_id ) {
		$assignment_repo = new Quire_Repo_Assignment();
		$assignment_repo->buildRelationship( $order_id );
	}
}

function quire_add_cookie_to_dev_site( $cookie, $expire, $expiration, $user_id, $logged_in, $token ) {
	if ( $logged_in === 'logged_in' ) {
		setcookie(
			LOGGED_IN_COOKIE,
			$cookie,
			$expire,
			'',
			'quireapp.local',
			false,
			true
		);
	} else {
		setcookie(
			AUTH_COOKIE,
			$cookie,
			$expire,
			'',
			'quireapp.local',
			false,
			true
		);
	}
}