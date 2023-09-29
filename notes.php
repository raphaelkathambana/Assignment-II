<?php
    include_once 'Note.php';
    require_once 'autoload.php';
    //check if form was submitted
    if (isset($_POST['save-note'])) {
        //get form data
        $title = $_POST['title'];
        $body = $_POST['note'];
        $id = $_POST['id'];
        echo /*html*/ '<pre>';
        var_dump($_POST);
        echo /*html*/ '</pre>';
        //create note object
        $note = new Note();
        //save note
        $result = $note->save($title, $body, $id);
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
    //check if update id was passed
    if (isset($_POST['update-note'])) {
        //get form data
        $title = $_POST['title'];
        $body = $_POST['note'];
        $id = $_POST['id'];
        echo /*html*/ '<pre>';
        var_dump($_POST);
        echo /*html*/ '</pre>';
        //create note object
        $note = new Note();
        //update note
        $result = $note->update($title, $body, $id);
        //check if note was updated
        if ($result) {
            //redirect to index with query string
            header('Location: index.php?message=Note updated');
        } else {
            //redirect to index with query string
            header('Location: index.php?message=Note not updated');
        }
    }
