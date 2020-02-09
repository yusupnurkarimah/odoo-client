<pre>
<?php 
include "ripcord/ripcord.php";

$url		= "http://localhost:8069";
$username	= "admin";
$password	= "1";
$dbname		= "ear1";

/* login */
echo "<h2>login proccess</h2>";

$common = ripcord::client("$url/xmlrpc/2/common");
$uid = $common->authenticate($dbname, $username, $password, array());
var_dump($uid);

/* create $models object */
$models = ripcord::client("$url/xmlrpc/2/object");
/* search ID course */
$ids = $models->execute_kw($dbname, $uid, $password, 
	'res.partner', 'search', 
		array(
			array(
				array('name','=','budi'),
			)
		)
	);
var_dump($ids);

echo "<h2>delete course with id=$ids[0] </h2>";

$ret = $models->execute_kw($dbname, $uid, $password, 
    'res.partner', 'unlink',
    array(
    	$ids, 
    )
);
var_dump($ret);
