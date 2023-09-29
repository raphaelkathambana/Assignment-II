<?php
require_once 'autoload.php';
session_start();
$layout = new Layout();
$layout->header('Login Page');
$layout->navbar();
?>
    <h1>Your Details</h1>
    <div>
        <?php
        if (isset($_SESSION['user'])) : ?>
            <div>
                <div><p>Name: <?php echo $_SESSION['user']->getName(); ?></p></div>
                <div><p>Email: <?php echo $_SESSION['user']->getEmail(); ?></p></div>
                <div><p>Id: <?php echo $_SESSION['user']->getId(); ?></p></div>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
