<?php

class Post extends User
{

    protected function createPostTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `$this->postTable` (
                    `id`          INT(11)                              NOT NULL AUTO_INCREMENT , 
                    `user_id`     INT(11)                              NOT NULL , 
                    `post`        VARCHAR(225)                         NOT NULL , 
                    `reaction_id` INT(11)                              NOT NULL , 
                    `create_time` DATETIME                             NOT NULL DEFAULT CURRENT_TIMESTAMP , 
                    `update_time` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
                        PRIMARY KEY (`id`), 
                        UNIQUE `REACTIONS` (`reaction_id`)) 
                            ENGINE=InnoDB;
                ALTER TABLE `$this->postTable`
                    ADD CONSTRAINT `f_reaction_id` FOREIGN KEY (`reaction_id`) 
                        REFERENCES `$this->reactionTable` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
                    ADD CONSTRAINT `f_user_id`     FOREIGN KEY (`user_id`)     
                        REFERENCES `$this->userTable` (`id`)     ON DELETE CASCADE ON UPDATE NO ACTION;";

        if ($this->conn()->query($sql) == TRUE) return True;
        return False;
    }

    protected function get_post_column_by_id(string $column, int $postId)
    {
        $conn = $this->conn();
        $sql = "SELECT `$column` FROM `$this->postTable` WHERE id = `$postId`";
        $result = mysqli_fetch_assoc(mysqli_query($conn, $sql));
        $conn->close();
        return $result;
    }

    protected function add_new_post()
    {
        $conn = $this->conn();
        $sql = "";
    }

    protected function get_post_by_id(int $post_id)
    {
        $conn = $this->conn();
        $sql = "SELECT * FROM $this->postTable AS post WHERE post.id = `$post_id`";
        $result = mysqli_fetch_assoc(mysqli_query($conn, $sql));
        $conn->close();
        return $result;
    }

    public function get_all_posts(int $limit = 5): array
    {
        $conn = $this->conn();
        $sql = "SELECT * FROM $this->postTable LIMIT $limit";

        $result = [];

        if ($queried_result = mysqli_query($conn, $sql)) {
            while ($fetched = mysqli_fetch_assoc($queried_result)) {
                array_push($result, $fetched);
            }
        }

        $conn->close();
        return $result;
    }
}
