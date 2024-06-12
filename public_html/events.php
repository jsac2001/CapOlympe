<?php
require $_SERVER['DOCUMENT_ROOT'] . '/ressources/library/databaseFunctions.php';
include $_SERVER['DOCUMENT_ROOT'] . '/ressources/templates/header.php';
$events = getAllEvents();
$users = getAllUsers();
$events = getAllEvents();
$categories = getAllCategories();
?>
<div class="events_body">


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
    </aside>
    <?php
foreach ($events as $event)
?>

<div class= "event">
    <div class="event-card">
        <img class="event-banner" src="../../public_html/img/content/<?= safeHtml($event['event_background']) ?>" alt="Event Banner" />
        <div class="event_avatar_holder">
            <img src="../../public_html/img/content/john_doe.svg" alt="">
        </div>  
    </div>

    <div class="event-content">
        <div class="event-info">
            <div class="event-title">
            <div class="event-title-text"><?= safeHtml($event['title']) ?></div>
            <div class="event-location-type"><?= safeHtml($event['status']) == 1 ? 'Publique' : 'Privée' ?></div>
            </div>
            <div class="event-details">
                <div class="event-detail">
                    <div class="event-date-icon"><img src="../../public_html/img/content/calendar_icon.svg" alt=""></div>
                    <div class="event-detail-text"><?= safeHtml($event['event_date']) ?></div>
                </div>
                <div class="event-detail">
                    <div class="event-location-icon"><img src="../../public_html/img/content/localisation_icon.svg" alt=""></div>
                    <div class="event-detail-text"><?= safeHtml($event['location']) ?></div>
                </div>
                <div class="event-detail">
                    <div class="event-participants-icon" >
                        <img src="../../public_html/img/content/profile_icon_event.svg" alt="">
                    </div>
                    <div class="event-detail-text"><?= safeHtml($event['participant_number']) ?> participants</div>
                </div>
            </div>
            <div class="event-description">
            <?= nl2br(safeHtml($event['description'])) ?>
        </div>
    </div>
   
</div>
