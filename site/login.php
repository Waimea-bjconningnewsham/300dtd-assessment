<?php require_once '_top.php'; ?>


<h2>Login</h2>

<form action="do-login.php" method="post">

    <label>Email</label>
    <input name="user" type="text" required>

    <label>Password</label>
    <input name="pass" type="password" required>

    <input type="submit" value="Login">
</form>

<?php require_once '_bottom.php'; ?>


