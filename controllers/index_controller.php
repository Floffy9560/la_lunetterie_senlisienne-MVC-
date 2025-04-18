<?php

include __DIR__ . '/../views/acceuil.php';


if (isset($_SESSION['flash'])) {
      $flash = $_SESSION['flash'];
      unset($_SESSION['flash']);
}
