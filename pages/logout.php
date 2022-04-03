<?php

session_start();
unset($_SESSION['connected']);
header('Location: login.php?action=logout');