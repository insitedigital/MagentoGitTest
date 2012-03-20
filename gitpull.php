<?php

// Report all PHP errors
error_reporting(-1);

// Same as error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);

$fh = fopen("logfile.php", "a+" ) ;
$result = "HERE!\n\n\n";
?>
<?php //`git pull`;
fputs($fh, $result, strlen($result));

define('PROJECTS_PATH', '/var/www/vhosts/gittest.net-development.co.uk/httpdocs');
/**
* server key for authentication
**/
define('SERVER_KEY', 'ABC123');

// parse the json payload
$payload = json_decode($_REQUEST['payload']);

if (!$payload){
$result = "No payload";
}
else
{
// check for payload and server key
if ( $payload->ref === 'refs/heads/master' && $_REQUEST['key'] == SERVER_KEY ) {
        // parse the payload for the project name
	$result = "Into Loop\n\n";
	fputs($fh, $result, strlen($result));
        $project_name = strtolower($payload->{'repository'}->{'name'});
		$result = "Payload\n\n";
	fputs($fh, $result, strlen($result));
        // define the cd directory based on config and project name
        $project_directory = PROJECTS_PATH;

		$result = "Projects\n\n";
	fputs($fh, $result, strlen($result));
        // cd into the project dir, git reset and pull changes
		//try{
			$result = "In try\n\n";
	fputs($fh, $result, strlen($result));
        $result = shell_exec('git pull origin master' );
		$log_result = serialize($result);
		fputs($fh, $result, strlen($result));
		$result = "Post Exec\n\n";
	fputs($fh, $result, strlen($result));
		//'git pull';
		//}
		//catch(Exception $e)
		{
		//	fputs($fh, $e, strlen($e));
		}
}
else
{
	$result = "Failed Loop\n\n" . $payload->ref . "\n\n" . $_REQUEST['key'] . "\n\n";
	fputs($fh, $result, strlen($result));
}
}
echo "<pre>$result</pre>";
fputs($fh, $result, strlen($result));
fclose($fh);


