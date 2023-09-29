<?php
//destroy session
session_start();
session_destroy();
//redirect to index
header('Location: index.php?message=Successfully Logged out');
exit;
