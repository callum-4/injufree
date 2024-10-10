<html>
    <head>
        <title>Sign up!</title>
    </head>

    <form method="post" id="signUpForm" action=".\formHandler.php">
        <h1>Sign up!</h1>
        <label for="firstName"> First Name</label>
        <input type="text" id="firstName" name="firstName" required maxlength="255">
        <br>
        <label for="secondName"> Second Name</label>
        <input type="text" id="secondName" name="secondName" required maxlength="255">
        <br>
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required maxlength="255">
        <br>
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required minlength="8" maxlength="255">
        <br>
        <input type="hidden" name="action" value="signUp">
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