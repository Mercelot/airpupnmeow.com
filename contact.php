<?php
// contact.php
require 'layout/header.php';
require 'layout/navbar.php';
require 'lib/functions.php';
?>

<h1>
    Helping you find your new best friend from over <?php echo count(getPets()); ?> pets.
</h1>