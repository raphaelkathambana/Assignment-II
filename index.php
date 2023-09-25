<?php
    include_once 'Note.php';
    require_once 'autoload.php';
    //check if form was submitted
    if (isset($_POST['save-note'])) {
        //get form data
        $title = $_POST['title'];
        $note = $_POST['note'];
        //create note object
        $note = new Note();
        //save note
        $result = $note->save($title, $note);
        //check if note was saved
        if ($result) {
            //redirect to index with query string
            header('Location: index.php?message=Note saved');
        } else {
            //redirect to index with query string
            header('Location: index.php?message=Note not saved');
        }
    }
    //check if delete id was passed
    if (isset($_GET['delete_id'])) {
        //get note id
        $id = $_GET['delete_id'];
        //create note object
        $note = new Note();
        //delete note
        $result = $note->delete($id);
        //check if note was deleted
        if ($result) {
            //redirect to index with query string
            header('Location: index.php?message=Note deleted');
        } else {
            //redirect to index with query string
            header('Location: index.php?message=Note not deleted');
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes App</title>
</head>

<body>
    <h1>Notes App</h1>
    <form action="notes.php" method="post" enctype="multipart/form">
        <label for="title">Title</label>
        <input type="text" name="title" id="title">
        <label for="note">Note</label>
        <textarea name="note" id="note" cols="30" rows="10"></textarea>
        <input type="submit" value="Save" name="save-note">
        <?php
            if (isset($_GET['message'])) {
                echo "<p>{$_GET['message']}</p>";
            }
        ?>
    </form>

    <div>
        <h1>Previous Notes</h1>
        <?php
            //get notes from database
            $note = new Note();
            $notes = $note->getNotes();
            //check if there are any notes
            if ($notes) {
                //display notes
                foreach ($notes as $note) {
                    echo /*html*/"<h3>{$note['title']}</h3>";
                    echo /*html*/"<p>{$note['body']}</p>";
                    echo /*html*/"<p>{$note['created_at']}</p>";
                    echo /*html*/"<a href='notes.php?delete_id={$note['id']}'>Delete</a>";
                }
            } else {
                echo "<p>No notes</p>";
            }
        ?>
    </div>
</body>
</html>
