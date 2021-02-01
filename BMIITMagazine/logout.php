<?php
session_start();
session_unset();
session_destroy();
header_remove();
header("Location: index.php");
