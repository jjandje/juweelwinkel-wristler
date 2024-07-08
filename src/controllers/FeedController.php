<?php

namespace JuweelwinkelWristler\controllers;

class FeedController
{
	
	
	public function index( $request )
	{
		$watches = get_posts([
			'post_type' => 'company',
			'numberposts' => -1,
			'fields' => [
				'ID',
				'post_title',
				'post_name',
				'post_status',
				'post_type',
				'post_modified',
			]
		]);
		
		return rest_ensure_response($watches);
	}
}