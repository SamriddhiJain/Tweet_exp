<?php
	require_once('TwitterAPIExchange.php');

	/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
	$settings = array(
	    'oauth_access_token' => "4733276482-5JSpMp8KqjhhiELjez8FpIdy2ZzClnUVaL7ru54",
	    'oauth_access_token_secret' => "BcUvJ6U4frtu5ITbgOzYmNY4dU0RDiSinRNXUK7DV8nlX",
	    'consumer_key' => "s32ku8Q9COXIZc84MoE71j9wK",
	    'consumer_secret' => "6yKHtC4onmBx5vBenEj4uQwCXwL9omwKeX2dRqBy9PC6WeDXG5"
	);

	$url = 'https://api.twitter.com/1.1/search/tweets.json';
	$requestMethod = 'GET';
	$string="Earthquake India";
	$notweets = 50;
	$maxId="";

	for($i=1;$i<100;$i++){
		$getfield = '?max_id='.$maxId.'&q='.$string.'&count='.$notweets;

		// Perform the request
		$twitter = new TwitterAPIExchange($settings);
		$tweet = $twitter->setGetfield($getfield)
		             ->buildOauth($url, $requestMethod)
		             ->performRequest();

		$tweets=json_decode($tweet);

		$json=$tweets->statuses;
		$search_data=$tweets->search_metadata;

		foreach ($json as $var){
			$o_user=$var->user;
			$r_user = (isset($var->retweeted_status) ? $var->retweeted_status : false);

			if($r_user){
				$ret_user=$var->retweeted_status->user;
			}else{
				$ret_user=$o_user;
			}
			
			echo $o_user->name,",",$ret_user->name,",",$o_user->time_zone,",",$var->created_at;		
			echo PHP_EOL;
		}

		$search_data->next_results = (isset($search_data->next_results) ? $search_data->next_results : false);
		
		if($search_data->next_results){
			$re = "/\\?max_id=([0-9]*)&q=/"; 
			$str = $search_data->next_results; 
			 
			preg_match($re, $str, $match);
			//var_dump($match);
			$maxId=$match[1];
		}else{
			break;
		}
	}
?>
