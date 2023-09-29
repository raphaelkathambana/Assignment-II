<?php
include_once 'Note.php';
require_once 'autoload.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes App</title>
</head>

<body>
    <a href="/" style="text-decoration: none; color: #000;">
        <h1>Notes App</h1>
    </a>
    <div>
        <?php
        if (isset($_SESSION['user'])) { ?>
            <a href='profile.php'>
                <?php echo $_SESSION['user']->getName(); ?>
                <?php echo $_SESSION['user']->getId(); ?>
            </a>
            <a href='logout.php'>Logout</a>
        <?php } else { ?>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        <?php } ?>
        <a href="test.php">Testing Area</a>
    </div><br />
    <div>
        <?php
        if (isset($_SESSION['user'])) : ?>
            <form action="notes.php" method="post" enctype="multipart/form">
                <?php
                if (isset($_GET['update_id'])) {
                    $id = $_GET['update_id'];
                    $note = new Note();
                    $result = $note->getNoteById($id);
                    if ($result) {
                        $note = new Note($result->getId(), $result->getTitle(), $result->getBody(), $result->getUserId(), $result->getCreatedAt(), $result->getUpdatedAt());
                        echo /*html*/"<input type='hidden' name='id' id='id' value='{$note->getId()}'>";
                        echo /*html*/"<label for='title'>Title</label>";
                        echo /*html*/"<input type='text' name='title' id='title' value='{$note->getTitle()}'>";
                        echo /*html*/"<label for='note'>Note</label>";
                        echo /*html*/"<textarea name='note' id='note' cols='30' rows='10'>{$note->getBody()}</textarea>";
                        echo /*html*/"<input type='submit' value='Update' name='update-note'>";
                    }
                } else { ?>
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title">
                    <label for="note">Note</label>
                    <textarea name="note" id="note" cols="30" rows="10"></textarea>
                    <input type="hidden" name="id" id='id' value="<?php echo $_SESSION['user']->getId(); ?>">
                    <input type="submit" value="Save" name="save-note">
                    <?php
                }
                if (isset($_GET['message'])) {
                    echo "<p>{$_GET['message']}</p>";
                }
                ?>
            </form>
        </div>


        <div>
            <h1>Past Notes</h1>
            <?php
            //get notes from database
            $note = new Note();
            $notes = $note->getNoteObjects();
            //check if there are any notes
            if ($notes) {
                //display notes
                foreach ($notes as $note) {
                    $aNote = new Note($note->getId(), $note->getTitle(), $note->getBody(), $note->getUserId(), $note->getCreatedAt(), $note->getUpdatedAt());
                    echo /*html*/"<h3>{$note->getTitle()}</h3>";
                    echo /*html*/"<p>{$note->getBody()}</p>";
                    echo /*html*/"<p>{$note->getCreatedAt()}</p>";
                    echo /*html*/"<p>{$note->getUserId()}</p>";
                    echo /*html*/"<a href='notes.php?delete_id={$note->getId()}'>Delete</a>";
                    echo /*html*/"<br>";
                    echo /*html*/"<a href='index.php?update_id={$note->getId()}'>Update</a>";
                }
            } else {
                echo "<p>No notes</p>";
            }
            ?>
        </div>
    <?php endif;
        ?>
</body>
</html>
