<?php

class Unlaik extends Post
{
    protected function createReactionTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `$this->reactionTable` (
            `id`            INT(11)     NOT NULL AUTO_INCREMENT , 
            `reactions`     JSON        NOT NULL                  DEFAULT '{\"likes\": [], \"dislikes\": [] }' , 
            `like_count`    INT(11)     NOT NULL                  DEFAULT '0' , 
            `dislike_count` INT(11)     NOT NULL                  DEFAULT '0' , 
                PRIMARY KEY (`id`)) 
                    ENGINE = InnoDB;";
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

    protected function get_post_react(int $reactionId)
    {
        $conn = $this->conn();
        $sql = "SELECT * FROM `$this->reactionTable` WHERE id = `$reactionId`";
        $result = mysqli_fetch_assoc(mysqli_query($conn, $sql));
        $conn->close();
        return $result;
    }

    protected function get_user_react(int $reactionId, int $userId)
    {
        $reaction = json_decode($this->get_post_react($reactionId), true);

        $likes = $reaction['likes'];
        $dislikes = $reaction['dislikes'];

        if(in_array($userId, $likes)) return 'liked';
        if(in_array($userId, $dislikes)) return 'disliked';
        return 'UnReacted';
    }

    protected function add_like(int $rectionId, int $userId)
    {
    
    }

    protected function alter_react(int $userId, string $reaction = 'like')
    {
    }
}
