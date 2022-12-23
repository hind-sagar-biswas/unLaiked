<?php

class Unlaik extends Post
{
    protected function createReactionTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `$this->reactionTable` (
                    `post_id`  INT(11)      NOT NULL , 
                    `user_id`  INT(11)      NOT NULL , 
                    `reaction` VARCHAR(225) NOT NULL DEFAULT 'like' , 
                        PRIMARY KEY (`post_id`, `user_id`))
                            ENGINE = InnoDB;
                ALTER TABLE `$this->reactionTable` 
                    ADD CONSTRAINT `POST_REACTION_KEY` FOREIGN KEY (`post_id`) 
                        REFERENCES `posts`(`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
                    ADD CONSTRAINT `USER_REACTION_KEY` FOREIGN KEY (`user_id`) 
                        REFERENCES `users`(`id`) ON DELETE CASCADE ON UPDATE NO ACTION;";
        if ($this->conn()->query($sql) == TRUE) return True;
        return False;
    }

    public function un_laiked_init(bool $init_all = True): array
    {
        if ($this->createReactionTable() === False) return [False, 'Failed @ initialization!'];
        if ($init_all) {
            if ($this->createUserTable() === False) return [False, 'Failed @ User table creation!'];
            if ($this->createPostTable() === False) return [False, 'Failed @ Posts table creation!'];
        }
        return [True, 'Initialization Successful!'];
    }

    protected function get_post_react(int $postId): array|false|null
    {
        $conn = $this->conn();
        $sqlLike = "SELECT post_id FROM `$this->reactionTable` WHERE post_id = `$postId` && reaction = `like`";
        $sqlDislike = "SELECT post_id FROM `$this->reactionTable` WHERE post_id = `$postId` && reaction = `dislike`";

        $queriedResult = [mysqli_query($conn, $sqlLike), mysqli_query($conn, $sqlDislike)];
        $reactionCount = ["likes" => mysqli_num_rows($queriedResult[0]), "dislikes" =>  mysqli_num_rows($queriedResult[1])];
        $conn->close();

        return $reactionCount;
    }

    public function get_user_react(int $postId, int $userId): false|array|null
    {
        $conn = $this->conn();
        $sql = "SELECT reaction FROM `$this->reactionTable` WHERE post_id = `$postId` && user_id = `$userId`";
        $query = mysqli_query($conn, $sql);

        $reaction = (mysqli_num_rows($query) != 1) ? false : mysqli_fetch_assoc($query);
        return $reaction;
    }

    protected function set_reaction($reactionId, $reaction): bool
    {
        $conn = $this->conn();

        $reaction = json_encode($reaction);
        $sql = "UPDATE $this->reactionTable SET reaction='$reaction' WHERE id='$reactionId'";
        $query = mysqli_query($conn, $sql);
        $conn->close();

        if ($query)  return True;
        return False;
    }

    protected function remove_reaction(int $postId, int $userId): bool
    {
        $sql = "DELETE FROM `$this->reactionTable` WHERE post_id='$postId' && user_id = '$userId'";
        if ($this->conn()->query($sql)) return True;
        return False;
    }

    protected function alter_react(int $postId, int $userId, string $react = 'like'): bool
    {
        if ($react != 'like' || $react != 'dislike') return False;

        $currentReaction = $this->get_user_react($postId, $userId);

        if ($currentReaction === false) $sql = "INSERT INTO `$this->reactionTable`(post_id, user_id, reaction) VALUES('$postId', '$userId', '$react');";
        else if ($currentReaction != $react) $sql = "UPDATE $this->reactionTable SET reaction='$react' WHERE post_id='$postId' && user_id = '$userId';";
        else return $this->remove_reaction($postId, $userId);

        if($this->conn()->query($sql)) return True;
        return False;
    }
}
