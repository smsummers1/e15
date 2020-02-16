<?php

//start the session
session_start();

//retreive session data
$results = $_SESSION['results'];

require 'done-view.php';