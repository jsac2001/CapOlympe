<?php
require $_SERVER['DOCUMENT_ROOT'] . '/ressources/library/databaseFunctions.php';
include $_SERVER['DOCUMENT_ROOT'] . '/ressources/templates/header.php';
$posts = getAllPosts();
$categories = getAllCategories();
?>

<div class="feed_body">
    <aside class="category">
    <div class="title_category_holder">
        <h2>Sports</h2>
    </div>
    <?php
    foreach ($categories as $category) {
        ?>
        <div class='category_holder'>
            <div class='category_icon'><img src='../../public_html/img/content/<?= $category['icon'] ?>'></div>
            <ul>
                <li class='category_link'><a href='categories.php?id=<?= $category['id'] ?>'><?= htmlspecialchars($category['name']) ?></a></li>
            </ul>
        </div>
        <?php
    }
    ?>
    <div class="event_cta">
    <h3>Mes évènements</h3>
    </div>
    </aside>
    
    <div class="post">
    <?php foreach ($posts as $post): ?>
        <div class="post_holder">
            <div class="post_header">
                <div class="profile_picture">
                    <img src="/public_html/img/content/profile_icon.svg" alt="profile_icon">
                </div>
                <div class="user_name">
                    <a href='post.php?id=<?php echo $post["id"]; ?>'><?php echo htmlspecialchars($post["name"]); ?></a>
                </div>
                <div class="time_posted"><?php echo htmlspecialchars($post["created_at"]); ?></div>
            </div>
            <div class="post_image">
                <?php if ($post["image"]): ?>
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($post["image"]); ?>" alt="Post Image" />
                <?php endif; ?>
            </div>
            <div class="post_description"><?php echo nl2br(htmlspecialchars($post["post_description"])); ?></div>
        </div>
    <?php endforeach; ?>

</div>