<?php

$database_name = $_ENV["PERSISTENT_STORAGE_DIR"] ."/books.db";
$db = new SQLite3($database_name);
$query = "CREATE TABLE IF NOT EXISTS books (id INTEGER PRIMARY KEY, title STRING, author STRING)";
$db->exec($query);

function getBooks($db) {
    $query = "SELECT * FROM books";
    $results = $db->query($query);
    return $results;
}

if ($_POST) {
    if ($_POST["action"] == "create") {
        // Insert new book
        $title = $_POST["title"];
        $author = $_POST["author"];
        $stmt = $db->prepare("INSERT INTO books (title, author) VALUES (:title, :author)");
        $stmt->bindValue(":title", $title, SQLITE3_TEXT);
        $stmt->bindValue(":author", $author, SQLITE3_TEXT);
        $stmt->execute();
    }
    elseif ($_POST["action"] == "update") {
        $id = $_POST['update_id'];
        $title = $_POST['new_title'];
        $author = $_POST['new_author'];
        $stmt = $db->prepare("UPDATE books SET title=:title, author=:author WHERE id=:id");
        $stmt->bindValue(':title',$title,SQLITE3_TEXT);
        $stmt->bindValue(':author',$author,SQLITE3_TEXT);
        $stmt->bindValue(':id',$id,SQLITE3_INTEGER);
        $stmt->execute();
    }

    elseif ($_POST["action"] == "delete") {
        $id = $_POST['delete_id'];
        $stmt = $db->prepare('DELETE FROM books WHERE id=:id');
        $stmt->bindValue(':id',$id,SQLITE3_INTEGER);
        $stmt->execute();
    }
}
?>



