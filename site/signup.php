<?php require_once '_top.php'; ?>


<h2>Sign Up for a New Account</h2>

<form action="do-signup.php" method="post">

    <label>Name</label>
    <input name="name" type="text" required>

    <label>Email Address</label>
    <input name="email" type="text" required>

    <label>Password</label>
    <input name="pass" type="password" required>

    <input type="submit" value="Sign Up">
</form>

<?php require_once '_bottom.php'; ?>


