<?php

require __DIR__ . '/../models/fonctions_inscription.php';

render('inscription', false, [
      'error' => $error,
]);
