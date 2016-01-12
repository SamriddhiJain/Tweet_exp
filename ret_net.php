<?php
	require_once("twitteroauth-master/twitteroauth/twitteroauth.php");
	$string="Earthquake India";
	/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
	
	$consumerkey = "s32ku8Q9COXIZc84MoE71j9wK"; 
	$consumersecret = "6yKHtC4onmBx5vBenEj4uQwCXwL9omwKeX2dRqBy9PC6WeDXG5"; 
	$accesstoken = "4733276482-5JSpMp8KqjhhiELjez8FpIdy2ZzClnUVaL7ru54"; 
	$accesstokensecret = "BcUvJ6U4frtu5ITbgOzYmNY4dU0RDiSinRNXUK7DV8nlX";
	$notweets = 500;

	function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
	  $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
	  return $connection;
	}

	$connection = getConnectionWithAccessToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);

	$tweets = $connection->get("https://api.twitter.com/1.1/search/tweets.json?q=".urlencode($string)."&count=".$notweets);

	//echo $json;
	$json=$tweets->statuses;	
	var_dump($json);

	foreach ($json as $var){
		$o_user=$var->user;
		$r_user = (isset($var->retweeted_status) ? $var->retweeted_status : false);

		if($r_user){
			$ret_user=$var->retweeted_status->user;
		}else{
			$ret_user=$o_user;
		}
		
		echo $o_user->name,",",$ret_user->name;		
		echo PHP_EOL;
	}
?>