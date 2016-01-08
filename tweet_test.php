<?php
	require_once("twitteroauth-master/twitteroauth/twitteroauth.php");
	$string="Earthquake India";
	/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
	
	
	$notweets = 1;

	function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
	  $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
	  return $connection;
	}

	$connection = getConnectionWithAccessToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);

	$tweets = $connection->get("https://api.twitter.com/1.1/search/tweets.json?q=".urlencode($string)."&count=".$notweets);

	echo json_encode($tweets);  
?>