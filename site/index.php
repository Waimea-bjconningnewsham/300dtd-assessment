<?php require_once '_top.php'; ?>

<?php if ($loggedIn): $info  =  'Hi ' .$name. ', please place your order';;
      else:
         $info  = 'Please <b>sign up/log in</b> before you place your order';
      endif 

?>


<P><b>Find Us: </b>100 Lettuce Lane, Cheeseville<br>

<p><?= $info ?></p>
<br>
<b>ABOUT BURGERTOWN</b><br><br>
Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Placerat duis ultricies lacus sed turpis tincidunt id aliquet risus. Etiam tempor orci eu lobortis elementum nibh tellus molestie nunc.
</p>

<?php require_once '_bottom.php'; ?>


