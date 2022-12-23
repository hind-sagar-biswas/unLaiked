<h3>FEED: </h3>

<?php
$postList = $unlaik->get_all_posts();
foreach ($postList as $post) :
    $userReaction = (isset($_SESSION['user_id'])) ? $unlaik->get_user_react($post['id'], $_SESSION['user_id']) : '';
    $userReaction = ($userReaction) ? $userReaction['reaction'] : '';
    $postReactions = $unlaik->get_post_react($post['id']);

?>
    <div class="post-block">
        <p class="post-username" class="post-user"><?= $post['user_id'] . '| ' . $post['username'] ?></p>
        <p class="post">
            <?= $post['post'] ?>
        </p>
        <a class="<?php echo ($userReaction == 'like') ? $userReaction : ''; ?>" 
           href="<?= $INC . 'like.inc.php?l=1&p=' . $post['id'] ?>">
            <button>
                <i class="fas fa-thumbs-up"></i> 
                [<?= $postReactions['likes'] ?>]
            </button>
        </a>
        <a class="<?php echo ($userReaction == 'dislike') ? $userReaction : ''; ?>" 
           href="<?= $INC . 'like.inc.php?l=0&p=' . $post['id'] ?>">
            <button>
                <i class="fas fa-thumbs-down"></i> 
                [<?= $postReactions['dislikes'] ?>]
            </button>
        </a>
    </div>
<?php endforeach;
