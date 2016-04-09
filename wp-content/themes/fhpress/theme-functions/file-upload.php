<?php
require_once('../../../../wp-blog-header.php');
global $wpdb;
$ds          = DIRECTORY_SEPARATOR;
$imageKey = $_POST['ImageKey'];
$storeFolder = (!isset($_POST['store_folder'])) ? 'share_thumbs' : $_POST['store_folder'];
$filename = $_FILES['file']['name'];
$uploadDir = wp_upload_dir();
$route = $_POST['img_route'];

if (!empty($_FILES)) {

	if(!is_dir($uploadDir['basedir'] . $ds. $storeFolder . $ds . $imageKey . $ds . $route)) {
		mkdir(($uploadDir['basedir'] . $ds. $storeFolder . $ds . $imageKey . $ds . $route), 0777, true );
	}

	$tempFile = $_FILES['file']['tmp_name'];

	$targetPath = $uploadDir['basedir'] . $ds. $storeFolder . $ds . $imageKey . $ds . $route . $ds;

	$targetFile =  $targetPath. $filename;

	move_uploaded_file($tempFile,$targetFile);
	
	echo $filename;
}