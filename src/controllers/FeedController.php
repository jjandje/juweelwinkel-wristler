<?php

namespace JuweelwinkelWristler\controllers;

class FeedController
{
	
	
	public function index( $request )
	{
		$watches = get_posts([
			'post_type' => 'product',
			
		]);
		
		$response = new WP_REST_Response($watches);
	}
	
}