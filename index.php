<!DOCTYPE html>
<html lang="en">
<head>
<title>Bootstrap Example</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
<form method="post" action="" class="formSmall">
<div class="row">
<div class="col-lg-12">
<h7 class="text-align"> Download YouTube Video</h7>
</div>
<div class="col-lg-12">
<div class="input-group">
<input type="text" class="form-control" name="video_link" placeholder="Paste link.. e.g. https://www.youtube.com/watch?v=OK_JCtrrv-c">
<span class="input-group-btn">
<button type="submit" name="submit" id="submit" class="btn btn-primary">Go!</button>
</span>
</div><!-- /input-group -->
</div>
</div><!-- .row -->
</form>
<?php
require_once "class.youtube.php";
$yt  = new YouTubeDownloader();
$downloadLinks ='';
$error='';
if($_SERVER['REQUEST_METHOD'] == 'POST') {
$videoLink = $_POST['video_link'];
if(!empty($videoLink)) {
$vid = $yt->getYouTubeCode($videoLink);
if($vid) {
$result = $yt->processVideo($vid);
if($result) {
//print_r($result);
$info = $result['videos']['info'];
$formats = $result['videos']['formats'];
$adapativeFormats = $result['videos']['adapativeFormats'];
$videoInfo = json_decode($info['player_response']);
$title = $videoInfo->videoDetails->title;
$thumbnail = $videoInfo->videoDetails->thumbnail->thumbnails{0}->url;
}
else {
$error = "Something went wrong";
}
}
}
else {
$error = "Please enter a YouTube video URL";
}
}
?>
<?php if($formats):?>
<div class="row formSmall">
<div class="col-lg-3">
<img src="<?php print $thumbnail?>">
</div>
<div class="col-lg-9">
<?php print $title?>
</div>
</div>
<div class="card formSmall">
<div class="card-header">
<strong>With Video & Sound</strong>
</div>
<div class="card-body">
<table class="table ">
<tr>
<td>Type</td>
<td>Quality</td>
<td>Download</td>
</tr>
<?php foreach ($formats as $video) :?>
<tr>
<td><?php print $video['type']?></td>
<td><?php print $video['quality']?></td>
<td><a href="downloader.php?link=<?php print urlencode($video['link'])?>&title=<?php print urlencode($title)?>&type=<?php print urlencode($video['type'])?>">Download</a> </td>
</tr>
<?php endforeach;?>
</table>
</div>
</div>
<div class="card formSmall">
<div class="card-header">
<strong>Videos video only/ Audios audio only</strong>
</div>
<div class="card-body">
<table class="table ">
<tr>
<td>Type</td>
<td>Quality</td>
<td>Download</td>
</tr>
<?php foreach ($adapativeFormats as $video) :?>
<tr>
<td><?php print $video['type']?></td>
<td><?php print $video['quality']?></td>
<td><a href="downloader.php?link=<?php print urlencode($video['link'])?>&title=<?php print urlencode($title)?>&type=<?php print urlencode($video['type'])?>">Download</a> </td>
</tr>
<?php endforeach;?>
</table>
</div>
</div>
<?php endif;?>
</div>
</body>
</html>
