<?php

class Like extends Post
{
    protected function createReactionTable()
    {
        $sql = "CREATE TABLE `$this->reactionTable` (
            `id` INT(11) NOT NULL AUTO_INCREMENT , 
            `likes` JSON NULL , 
            `like_count` INT(11) NOT NULL DEFAULT '0' , 
            `dislikes` JSON NULL , 
            `dislike_count` INT(11) NOT NULL DEFAULT '0' , 
                PRIMARY KEY (`id`)) 
                    ENGINE = InnoDB;";
    }
}
