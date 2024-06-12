<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ressources/config.php';

function getAllCategories() {
    global $pdo;
    
    try {
        $sql = "
            SELECT c.id, c.icon, c.name
            FROM categories c
        ";
        $query = $pdo->prepare($sql);
        $query->execute();
        $posts = $query->fetchAll(PDO::FETCH_ASSOC);
        return $posts;
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
}
function getAllPosts() {
    global $pdo;
    
    try {
        $sql = "
            SELECT p.id, p.created_at, p.image, p.post_description, u.name 
            FROM posts p
            INNER JOIN users u ON p.user_id = u.id
        ";
        $query = $pdo->prepare($sql);
        $query->execute();
        $posts = $query->fetchAll(PDO::FETCH_ASSOC);
        return $posts;
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
}

function getPost($id) {
    global $pdo;

    try {
        $sql = "
            SELECT p.id, p.created_at, p.image, p.post_description, u.name, c.id
            FROM posts p
            INNER JOIN users u ON p.user_id = u.id
            INNER JOIN categories c ON p.category_id = c.id
            WHERE p.id = :id
        ";
        $query = $pdo->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $post = $query->fetch(PDO::FETCH_ASSOC);
        return $post;
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
}
function getAllEvents() {
    global $pdo;
    
    try {
        $sql = "
            SELECT e.event_background, u.name, e.status, e.title, e.location, e.event_date, e.participant_number, e.description
            FROM events e
            INNER JOIN users u ON e.user_id = u.id
        ";
        $query = $pdo->prepare($sql);
        $query->execute();
        $events = $query->fetchAll(PDO::FETCH_ASSOC);
        return $events;
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
}

function getEvent($id) {
    global $pdo;

    try {
        $sql = "
            SELECT e.event_background, u.name as user_name, e.status, e.title, e.location, e.event_date, e.participant_number, e.description
            FROM events e
            INNER JOIN users u ON e.user_id = u.id
            WHERE e.id = :id
        ";
        $query = $pdo->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $event = $query->fetch(PDO::FETCH_ASSOC);
        return $event;
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
}



function getAllUsers() {
    global $pdo;
    
    try {
        $sql = "
            SELECT ue.user_id, ue.event_id, e.event_background, e.status, u.image, u.name, e.title, e.location, e.event_date, e.participant_number, e.description
            FROM users_events ue
            JOIN users u ON ue.user_id = u.id
            JOIN events e ON ue.event_id = e.id
        ";
        $query = $pdo->prepare($sql);
        $query->execute();
        $users = $query->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
}

function safeHtml($string) {
    return htmlspecialchars($string ?? '', ENT_QUOTES, 'UTF-8');
}



function getEventUsers($eventId, $status) {
    global $pdo;

    try {
        $sql = "
            SELECT u.name, u.image, ue.interest_status
            FROM users u
            INNER JOIN users_events ue ON u.id = ue.user_id
            WHERE ue.event_id = :event_id AND ue.interest_status = :status
        ";
        $query = $pdo->prepare($sql);
        $query->bindParam(':event_id', $eventId, PDO::PARAM_INT);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
}


