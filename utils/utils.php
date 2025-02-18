<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
function render($path, $template = false, $data = [])
{
	if ($template) {
		require "templates/$path.php";
	} else {
		require "views/$path.php";
	}
}
