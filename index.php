<?php
include_once 'Note.php';
require_once 'autoload.php';
session_start();
$layout = new Layout();
$layout->header('Notes App');
$layout->navbar();
if (isset($_GET['message'])) {
    echo /*html*/"<p class='message'>{$_GET['message']}</p>";
}
?>

    <div class='container'>
        <?php
        if (isset($_SESSION['user'])) : ?>
            <form action="notes.php" method="post" enctype="multipart/form" class='note'>
                <?php
                if (isset($_GET['update_id'])) {
                    $id = $_GET['update_id'];
                    $note = new Note();
                    $result = $note->getNoteById($id);
                    if ($result) {
                        $note = new Note($result->getId(), $result->getTitle(), $result->getBody(), $result->getUserId(), $result->getCreatedAt(), $result->getUpdatedAt());
                        echo /*html*/"<input type='hidden' name='id' id='id' value='{$note->getId()}'>";
                        echo /*html*/"<label class='heading-tertiary' for='title'>Title</label>";
                        echo /*html*/"<input type='text' name='title' id='title' value='{$note->getTitle()}'>";
                        echo /*html*/"<label class='heading-tertiary' for='note'>Note</label>";
                        echo /*html*/"<textarea class='note-text' name='note' id='note' cols='30' rows='10'>{$note->getBody()}</textarea>";
                        echo /*html*/"<input type='submit' value='Update' name='update-note' class='btn'>";
                    }
                } else { ?>
                    <label class="heading-tertiary" for="title">Title</label>
                    <input type="text" name="title" id="title">
                    <label class="heading-tertiary" for="note">Note</label>
                    <textarea class='note-text' name="note" id="note" cols="30" rows="10"></textarea>
                    <input type="hidden" name="id" id='id' value="<?php echo $_SESSION['user']->getId(); ?>">
                    <input type="submit" value="Save" name="save-note" class='btn'>
                    <?php
                }
                ?>
            </form>
        </div>


        <div class='note'>
            <div class="header">
                <h1>Past Notes</h1>
            </div>
            <?php
            //get notes from database
            $note = new Note();
            $notes = $note->getNoteObjects();
            //check if there are any notes
            if ($notes) {
                //display notes
                $count = 0;
                foreach ($notes as $note) {
                    $aNote = new Note($note->getId(), $note->getTitle(), $note->getBody(), $note->getUserId(), $note->getCreatedAt(), $note->getUpdatedAt());
                    if ($aNote->getUserId() == $_SESSION['user']->getId()) {
                        $count++;
                        echo /*html*/"<h3>{$note->getTitle()}</h3>";
                        echo /*html*/"<p class='paragraph'>{$note->getBody()}</p>";
                        echo /*html*/"<p class='paragraph'>{$note->getCreatedAt()}</p>";
                        echo /*html*/"<p>{$note->getUserId()}</p>";
                        echo /*html*/"<a href='notes.php?delete_id={$note->getId()}'>Delete</a>";
                        echo /*html*/"<br>";
                        echo /*html*/"<a class='note-delete' href='index.php?update_id={$note->getId()}'>Update</a>";
                    } else {
                        if ($count > 0) {
                            echo /*html*/"<h3>You have No More Notes.</h3>";
                            break;
                        } else {
                            echo /*html*/"<h3>You have No Notes Yet.</h3>";
                            break;
                        }
                    }
                }
            } ?>
        </div>
    <?php endif;
        ?>
</body>
</html>
