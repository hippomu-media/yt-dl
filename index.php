<?php 
include('header.php');
include_once("db_connect.php");
?>
<link rel="stylesheet" href="css/style.css" />
<title>Demo of YouTube video downloader script in PHP</title>
 <meta name="keywords" content="Video downloader, download youtube, video download, youtube video, youtube downloader, download youtube FLV, download youtube MP4, download youtube 3GP, php video downloader" />
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">

<div class="container">
	<h2>Demo - YouTube video downloader script in PHP</h2>	
	<form class="form-download" method="get" id="download" action="getvideo.php">
		<input type="text" name="videoid" style="height:30px" id="videoid" size="40" placeholder="YouTube Video ID" />
		<input class="btn btn-primary" style="background:#3399ff;height:30px;color:white" type="submit" name="type" id="type"value="Download" />
		<p>Put in just the ID, the part after v=.</p>
		<p>Example: http://www.youtube.com/watch?v=<b>Wp-Dm-Swfeg</b></p>
		<?PHP
		include_once('config.php');
		function is_chrome(){
			$agent=$_SERVER['HTTP_USER_AGENT'];
			if( preg_match("/like\sGecko\)\sChrome\//", $agent) ){	// if user agent is google chrome
				if(!strstr($agent, 'Iron')) // but not Iron
					return true;
			}
			return false;	// if isn't chrome return false
		}
		?>
	</form>	
	
</div>
