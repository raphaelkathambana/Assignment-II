<?php
require_once 'autoload.php';
class Layout
{
    public static function header($title)
    {
        echo /*html*/"
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>$title</title>
        </head>
        <body>
        ";
    }
    public static function footer()
    {
        echo /*html*/"
        </body>
        </html>
        ";
    }
    public static function navbar()
    { ?>
        <a href='/' style='text-decoration: none; color: #000;'>
            <h1>Notes App</h1>
        </a>
        <div>
            <?php
            if (isset($_SESSION['user'])) { ?>
                <a href='profile.php'>
                    <?php echo $_SESSION['user']->getName(); ?>
                </a>
                <a href='logout.php'>Logout</a>
            <?php } else { ?>
                <a href="login.php">Login</a>
                <a href="register.php">Register</a>
            <?php } ?>
            <a href="test.php">Testing Area</a>
        </div><br />
        <?php
    }
}
