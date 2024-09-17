<?php require_once '_top.php'; ?>

<h2>Contact Us If You Have A Problem.</h2>

<b>Call Us: </b>0212056872<br><br>
<b>Email Us: </b>burgertown@gmail.com<br><br>
<b>Text Us: </b>0212056872<br><br>
<b>We're Here To Help If You Need Us Or Have A Complant!</b><br><br>
<b>Call Our Owner: </b>0212250064<br><br>
<b>Email Our Owner: </b>Regan.Small@gmail.com<br><br>
<b>Have A Great Day And Ejoy Our Website.</b><br><br>


<form
    hx-post="<?= SITE_BASE ?>/send-message"
    hx-trigger="submit"
    hx-swap="outerHTML"
>

    <label>Name</label>
    <input name="name" type="text" required>

    <label>Message</label>
    <textarea name="message" required></textarea>

    <input type="submit" value="Send">

</form>

<?php require_once '_bottom.php'; ?>


