<?php
// Report all PHP errors
error_reporting(-1);

// Same as error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);

$output1 = shell_exec('git pull origin master');
echo "<pre>$output1</pre>";
$output = shell_exec('git help');
echo "<pre>$output</pre>";
echo "here";
?>
