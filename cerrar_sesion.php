<?php
session_start();

session_unset();
session_destroy();
header("location:index.php?cr=1&nt=0");