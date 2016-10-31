<?php
    class Post{
        public function checkEmail($p_sEmail){
            $email = $p_sEmail;
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $uploadReady = 0;
                return $uploadReady;
            }else{
                $uploadReady = 1;
                return $uploadReady;
            }
        }

        public function subscribeNewsletter($p_sEmail){
            $uploadReady = 0;
            $post = new Post();

            $email = $p_sEmail;

            if(!$post->checkEmail($email)){
                $uploadReady = 0;
                return $uploadReady;
            }

            if($post->checkEmail($email)){
                //file_put_contents("emailsnewsletter.txt", $email . "\n", FILE_APPEND);
                $fp = fopen("../emailsnewsletter.txt", "a") or exit("Unable to open file!");
                fwrite($fp, $email . "\n");
                fclose($fp);
                return true;
            }else{
                return false;
            }
        }
    }
?>
