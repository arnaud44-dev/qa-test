<?php
// demarrage des sessions
session_start();
// fin des sessions
session_destroy();
header('location:index.php');