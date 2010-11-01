<!doctype html><html><head><title>Any Name iWant</title>
</head>
<body>
<?php

define('fb_appId','EDIT_ME');
define('fb_secret','EDIT_ME');

# Create the facebook object
if(defined('fb_appId')&&defined('fb_secret')){
 require_once('facebook.php');
 $facebook = new Facebook(array(
 'appId'  => fb_appId,
 'secret' => fb_secret,
 'cookie' => true,
 ));
}else die("Sie vergessen info.");

$me = null;
if($session = $facebook->getSession())
try{
 $me = $facebook->api('/me');
} catch(FacebookApiException $e){error_log($e);}

if($me){
 echo "Hello, $me[name].";
} else {
	$loginUrl = $facebook->getLoginUrl(array(
 'canvas' => 1,
 'fbconnect' => 0,
 ));
 echo "You are not logged in, or a first time user.";
	echo "<br /><a href='$loginUrl' target='_parent'>Login</a>";
	if(0)echo<<<EOF
<script type="text/javascript">
 self.parent.location = "$loginUrl"
</script>
EOF;
}


?></body></html>