<?php
require_once 'autoload.php';
session_start();
$layout = new Layout();
$layout->header('Register');
$layout->navbar();
?>
    <h1>Sign Up</h1>
    <form method="post" action="signUp.php" enctype="multipart/form-data">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br><br>
        <label for="email">Email:</label>
        <input type="email" name="email" required><br><br>
        <label for="password">Password:</label>
        <input type="password" name="password" required><br><br>
        <input type="submit" value="Sign Up" name="register">
    </form>
</body>
</html>
