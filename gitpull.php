<?php
$fh = fopen("logfile.php", "a+" ) 

?>
<?php //`git pull`;


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
        $project_name = strtolower($payload->{'repository'}->{'name'});
        // define the cd directory based on config and project name
        $project_directory = PROJECTS_PATH;

        // cd into the project dir, git reset and pull changes
        $result = shell_exec( 'cd ' . $project_directory . '/ && git reset --hard HEAD && git pull' );
}
}

fputs($fh, $result, strlen($result));
fclose($fh);

