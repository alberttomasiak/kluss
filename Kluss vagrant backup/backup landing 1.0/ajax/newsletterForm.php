<?php
include_once("../classes/Post.class.php");
$post = new Post();

if(!empty($_POST)){
	$email = $_POST['email'];

	if(!$post->checkEmail($email)){
		$uploadStatus['email'] = "false";
	}

	if($post->checkEmail($email)){
		$post->subscribeNewsletter($email);
		$uploadStatus['status'] = "success";
	}else{
		$uploadStatus['status'] = "error";
	}

	header('Content-Type: application/json; charset=utf-8', true);
	echo json_encode($uploadStatus);
}

?>
