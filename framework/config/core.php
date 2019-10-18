<?php
// Composer autoload
require(ROOT.'vendor/autoload.php');

// Load env variables
$dotenv = Dotenv\Dotenv::create(ROOT);
$dotenv->load();

// Load framework
require(FRAMEWORK_ROOT."config/db.php");
require(FRAMEWORK_ROOT."core/model.php");
require(FRAMEWORK_ROOT."core/controller.php");
require(FRAMEWORK_ROOT."core/helpers.php");
?>
