<?php
session_start();

if (empty($_SESSION["user"]) || $_SESSION["user_type"] != 1) {
  header('Location: ../../index.php');
}
