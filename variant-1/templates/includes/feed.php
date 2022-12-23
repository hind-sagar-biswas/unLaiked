<h3>FEED: </h3>

<?php
$postList = $unlaik->get_all_posts();
foreach ($postList as $post) : 
    $userReaction = (isset($_SESSION['user_id'])) ? $unlaik->get_user_reaction($post['reaction_id'], $_SESSION['user_id']) : '' ;
?>
    <div class="post-block">
        <h4 class="post-user">Username</h4>
        <p class="post">
            <?= $post['post'] ?>
        </p>
        <a class="<?php echo ($userReaction == 'liked') ? $userReaction : '' ; ?>" 
           href="<?= $INC . 'like.inc.php?l=1&p=' . $post['id'] ?>">
            <button>LIKE [<?= $post['like_count'] ?>]</button>
        </a>
        <a class="<?php echo ($userReaction == 'disliked') ? $userReaction : '' ; ?>" 
           href="<?= $INC . 'like.inc.php?l=0&p=' . $post['id'] ?>">
            <button>DILIKE [<?= $post['dislike_count'] ?>]</button>
        </a>
    </div>
<?php endforeach;
