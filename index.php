<?php
  session_start();
  if (isset($_SESSION['level'])) {
      if ($_SESSION['level'] == "moderator") {
        header('location:user.php');
      } elseif ($_SESSION['level'] == "admin") {
        header('location:admin.php');
      } else {
        header('location:error.php');
      }
  } else {
    header('location:login.php');
  }

?>