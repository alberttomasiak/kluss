<?php
include_once "classes/Post.class.php";

if(!empty($_POST)){
	$post = new Post();
	$post->subscribeNewsletter($_POST['email']);
}

?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Kluss</title>
        <?php include_once('includes/head.inc.php'); ?>
    </head>
    <body>
        <header>
            <h1>KLUSS is coming...</h1>
            <h2>Stay tuned!</h2>
            <p class="subscribe">Subscribe to our newsletter here:</p>
            <form class="" action="" id="newsletterForm" method="post">
                <p class="contactFeedback">
                    <?php if(isset($feedback)): ?>
						<p><?php echo $feedback; ?></p>
					<?php endif;?>
                </p>
                <input type="text" class="newsletterMail" id="email" name="email" placeholder="Your email...">
                <input type="submit" class="btnNewsletter form--button" name="name" value="Submit">
            </form>
        </header>
    </body>
</html>
