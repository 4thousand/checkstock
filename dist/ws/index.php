<?php
require 'vendor/autoload.php';
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
$app = new \Slim\App(['displayErrorDetails' => true]);

// CorsSlim for Cross domain request
$corsOptions = array(
    "origin" => "*",
    "exposeHeaders" => array("Content-Type", "X-Requested-With", "X-authentication", "X-client"),
    "allowMethods" => array("GET", "POST", "PUT", "DELETE", "OPTIONS")
    );

$cors = new \CorsSlim\CorsSlim($corsOptions);

$app->add($cors);

// Get Container
$container = $app->getContainer();


$app->post('/', function($request, $response){
	if(trim($_FILES["image"]["tmp_name"]) != "")
	{
		$file = $_FILES["image"]["name"]; 
		$images = $_FILES["image"]["tmp_name"];
		$random_digit=rand(000000,999999);
		$new_images = $random_digit.$_FILES["image"]["name"];
		$new_images = $random_digit.".jpg";
		copy($_FILES["image"]["tmp_name"],"../static/img/profile/".$file);
		$width=400; //*** Fix Width & Heigh (Autu caculate) ***//
		$size=GetimageSize($images);
		$height=round($width*$size[1]/$size[0]);
		$images_orig = ImageCreateFromJPEG($images);
		$photoX = ImagesX($images_orig);
		$photoY = ImagesY($images_orig);
		$images_fin = ImageCreateTrueColor($width, $height);
		ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
		ImageJPEG($images_fin,"../static/img/profile/".$new_images);
		ImageDestroy($images_orig);
		ImageDestroy($images_fin);
	}
	unlink('../static/img/profile/'.$file);
	$result = array("data" => $new_images );

	$newResponse = $response->withJson($result);
  	return $newResponse;
});

$app->post('/upload_item', function($request, $response){
  // $data = $request->getParam('data');
  if(trim($_FILES["image"]["tmp_name"]) != "")
	{
		$file = $_FILES["image"]["name"]; 
		$images = $_FILES["image"]["tmp_name"];
		$random_digit=rand(000000,999999);
		// $new_images = $random_digit.$_FILES["image"]["name"];
		$new_images = $random_digit.".jpg";
		copy($_FILES["image"]["tmp_name"],"../static/img/item/".$_FILES["image"]["name"]);
		$width=400; //*** Fix Width & Heigh (Autu caculate) ***//
		$size=GetimageSize($images);
		$height=round($width*$size[1]/$size[0]);
		$images_orig = ImageCreateFromJPEG($images);
		$photoX = ImagesX($images_orig);
		$photoY = ImagesY($images_orig);
		$images_fin = ImageCreateTrueColor($width, $height);
		ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
		ImageJPEG($images_fin,"../static/img/item/".$new_images);
		ImageDestroy($images_orig);
		ImageDestroy($images_fin);
	}
	unlink('../static/img/item/'.$file);
	$result = array("data" => $new_images );

	$newResponse = $response->withJson($result);
  	return $newResponse;
});

$app->post('/upload_profile', function($request, $response){
  // $data = $request->getParam('data');
  if(trim($_FILES["image"]["tmp_name"]) != "")
	{
		$file = $_FILES["image"]["name"]; 
		$images = $_FILES["image"]["tmp_name"];
		$random_digit=rand(000000,999999);
		// $new_images = $random_digit.$_FILES["image"]["name"];
		$new_images = $random_digit.".jpg";
		copy($_FILES["image"]["tmp_name"],"../static/img/profile/".$_FILES["image"]["name"]);
		$width=400; //*** Fix Width & Heigh (Autu caculate) ***//
		$size=GetimageSize($images);
		$height=round($width*$size[1]/$size[0]);
		$images_orig = ImageCreateFromJPEG($images);
		$photoX = ImagesX($images_orig);
		$photoY = ImagesY($images_orig);
		$images_fin = ImageCreateTrueColor($width, $height);
		ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
		ImageJPEG($images_fin,"../static/img/profile/".$new_images);
		ImageDestroy($images_orig);
		ImageDestroy($images_fin);
	}
	unlink('../static/img/profile/'.$file);
	$result = array("data" => $new_images );

	$newResponse = $response->withJson($result);
  	return $newResponse;
});

$app->run();

?>