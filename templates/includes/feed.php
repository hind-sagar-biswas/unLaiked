<h3>FEED: </h3>

<?php
$postList = $unlaik->get_all_posts();
foreach ($postList as $post) : 
    $userReaction = (isset($_SESSION['user_id'])) ? $unlaik->get_user_react($post['id'], $_SESSION['user_id'])['reaction'] : '' ;
    $postReactions = $unlaik->get_post_react($post['id']);

?>
    <div class="post-block">
        <h4 class="post-user"><?= $post['user_id'] . '| ' . $post['username'] ?></h4>
        <p class="post">
            <?= $post['post'] ?>
        </p>
        <a class="<?php echo ($userReaction == 'like') ? $userReaction : '' ; ?>" 
           href="<?= $INC . 'like.inc.php?l=1&p=' . $post['id'] ?>">
            <button>LIKE [<?= $postReactions['likes'] ?>]</button>
        </a>
        <a class="<?php echo ($userReaction == 'dislike') ? $userReaction : '' ; ?>" 
           href="<?= $INC . 'like.inc.php?l=0&p=' . $post['id'] ?>">
            <button>DISLIKE [<?= $postReactions['dislikes'] ?>]</button>
        </a>
    </div>
<?php endforeach;
