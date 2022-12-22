<?php

class Post extends User
{

    protected function createPostTable()
    {
        $sql = "CREATE TABLE `$this->postTable` (
                    `id` INT(11) NOT NULL AUTO_INCREMENT , 
                    `user_id` INT(11) NOT NULL , 
                    `post` VARCHAR(225) NOT NULL , 
                    `reaction_id` INT(11) NOT NULL , 
                    `create_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , 
                    `update_time` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
                        PRIMARY KEY (`id`), 
                        UNIQUE `REACTIONS` (`reaction_id`)) 
                            ENGINE=InnoDB;
                ALTER TABLE `$this->postTable`
                    ADD CONSTRAINT `f_reaction_id` 
                        FOREIGN KEY (`reaction_id`) REFERENCES `$this->reactionTable` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
                    ADD CONSTRAINT `f_user_id` 
                        FOREIGN KEY (`user_id`) REFERENCES `$this->userTable` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;";

        if ($this->conn()->query($sql) == TRUE) return True;
        return False;
    }

    protected function add_new_post()
    {
        $conn = $this->conn();
        $sql = "";
    }

    protected function get_post_by_id(int $post_id)
    {
        $conn = $this->conn();
        $sql = "SELECT * FROM $this->postTable AS post WHERE post.id = $post_id";
    }

    protected function get_all_post(int $limit = 5)
    {
        $conn = $this->conn();
        $sql = "SELECT * FROM $this->postTable LIMIT $limit";
    }
}
