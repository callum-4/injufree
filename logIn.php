<html>
    <head>
        <title>Log in!</title>
    </head>

    <form method="post" id="logInForm" action=".\formHandler.php">
        <h1>Log in!</h1>
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
        <br>
        <input type="hidden" name="action" value="logIn" required>
        <input type="submit" value="Submit">
    </form>

    <?php
    session_start();
    if (isset($_SESSION['error'])) {
        echo $_SESSION['error'];
        unset($_SESSION['error']);
    }
    ?>

    
</html>