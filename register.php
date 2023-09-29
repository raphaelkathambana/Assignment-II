<?php
require_once 'autoload.php';
session_start();
$layout = new Layout();
$layout->header('Register');
$layout->navbar();
?>
    <h1>Sign Up</h1>
    <form method="post" action="signUp.php" enctype="multipart/form-data" class='container'>
        <label class="heading-tertiary" for="email">Email:</label>
        <input type="email" name="email" required><br><br>
        <label class="heading-tertiary" for="username">Username:</label>
        <input type="text" name="username" required><br><br>
        <label class="heading-tertiary" for="password">Password:</label>
        <input type="password" name="password" required><br><br>
        <input type="submit" value="Sign Up" name="register" class='btn'>
    </form>
</body>
</html>
