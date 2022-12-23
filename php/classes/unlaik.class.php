<?php

class Unlaik extends Post
{
    public function __construct(bool $DEBUG = False)
    {
        $this->DEBUG = $DEBUG;
    }

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

    public function get_user_react(int $postId, int $userId): false|array|null
    {
        $conn = $this->conn();
        $sql = "SELECT reaction FROM `$this->reactionTable` WHERE post_id = '$postId' && user_id = '$userId'";
        $query = mysqli_query($conn, $sql);

        $reaction = (mysqli_num_rows($query) != 1) ? false : mysqli_fetch_assoc($query);
        return $reaction;
    }

    protected function remove_reaction(int $postId, int $userId, string $react = 'like'): bool
    {
        if ($react != 'like' && $react != 'dislike') return False;
        
        $sql_stmt = [
                "DELETE FROM `$this->reactionTable` WHERE post_id='$postId' && user_id = '$userId';",
                "UPDATE `$this->postTable` SET $react" . "_count = $react" . "_count - 1 WHERE id = '$postId';"
            ];
        foreach ($sql_stmt as $sql) {
            if (!$this->conn()->query($sql)) return False;
        }
        return True;
    }

    public function alter_react(int $postId, int $userId, string $react = 'like'): bool
    {
        if ($react != 'like' && $react != 'dislike') return False;
        if ($react == 'like') $oppositeReact = 'dislike';
        else  $oppositeReact = 'like';

        $currentReaction = $this->get_user_react($postId, $userId);

        if ($currentReaction === false) $sql_stmt = [
                "INSERT INTO `$this->reactionTable`(post_id, user_id, reaction) VALUES('$postId', '$userId', '$react');",
                "UPDATE `$this->postTable` SET $react" . "_count = $react" . "_count + 1 WHERE id = '$postId';"
            ];
        else if ($currentReaction['reaction'] != $react) $sql_stmt = [
                "UPDATE $this->reactionTable SET reaction='$react' WHERE post_id='$postId' && user_id = '$userId';",
                "UPDATE $this->postTable SET $react" . "_count = $react" . "_count + 1, $oppositeReact" . "_count = $oppositeReact" . "_count - 1 WHERE id = '$postId'"
            ];
        else return $this->remove_reaction($postId, $userId, $react);

        
        foreach ($sql_stmt as $sql) {
            if ($this->DEBUG) echo $sql;
            if (!$this->conn()->query($sql)) return False;
        }
        return True;
    }
}
