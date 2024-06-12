<?php 
require $_SERVER['DOCUMENT_ROOT'] . '/ressources/library/databaseFunctions.php';
include $_SERVER['DOCUMENT_ROOT'] . '/ressources/templates/header.php';

$eventId = 1; // juna => il faudra rajouter un client adaptable
$event = getEvent($eventId);
$interestedUsers = getEventUsers($eventId, 'Interested');
$participatingUsers = getEventUsers($eventId, 'Participating');



?>

<div class="event-page">
    <div class="event-users">
        <h3>Participants</h3>
        <ul>
            <?php foreach ($participatingUsers as $user): ?>
                <li>
                    <img src="../../public_html/img/content/<?= safeHtml($user['image']) ?>" alt="<?= safeHtml($user['name']) ?>">
                    <?= safeHtml($user['name']) ?>
                </li>
            <?php endforeach; ?>
        </ul>
        <h3>Intéressés</h3>
        <ul>
            <?php foreach ($interestedUsers as $user): ?>
                <li>
                    <img src="../../public_html/img/content/<?= safeHtml($user['image']) ?>" alt="<?= safeHtml($user['name']) ?>">
                    <?= safeHtml($user['name']) ?>
                </li>
            <?php endforeach; ?>
        </ul>
</div>


    
<div class="event-info">
            <div class="event-card">
                <img class="event-banner" src="../../public_html/img/content/<?= safeHtml($event['event_background']) ?>" alt="Event Banner" />
            
                <div class="event_avatar_holder">
                    <img src="../../public_html/img/content/john_doe.svg" alt="">
                </div>  
            </div>
            <div class="event-title">
                <div class="event-title-text"><?= safeHtml($event['title']) ?></div>
                <div class="event-location-type"><?= safeHtml($event['status']) == 1 ? 'Publique' : 'Privée' ?></div>
                <button id="interestedBtn">Mark as Interested</button>
                <button id="participatingBtn">Mark as Participating</button>
                <div id="message"></div>
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

<?php include "../ressources/templates/footer.php"; ?>
