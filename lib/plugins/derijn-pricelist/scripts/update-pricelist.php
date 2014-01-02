<?php
global $wpdb;
$name = trim($_REQUEST['name']);
$price = trim($_REQUEST['price']);

echo $name . ' ' . $price . ' ' . $wpdb->prefix;
?>