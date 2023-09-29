<?php
require_once 'autoload.php';
session_start();
$layout = new Layout();
$layout->header('Login');
$layout->navbar();
?>
<h1>Enter Your Details Below</h1>
    <?php
    if (isset($_GET['message'])) {
        echo "<p>{$_GET['message']}</p>";
    }
        ?>
    <form action="signIn.php" method="post" enctype="multipart/form-data" class='container'>
        <label class="heading-tertiary" for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        <label class="heading-tertiary" for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <input class="heading-tertiary" type="checkbox" id="show-password" onclick="togglePassword()"> Show Password<br><br>
        <input type="submit" value="Login" name='login' class='btn'>
    </form>
    <script>
        function togglePassword() {
            var passwordInput = document.getElementById("password");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        }
    </script>
</body>

</html>
