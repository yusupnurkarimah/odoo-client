<pre>
<?php 
include "ripcord/ripcord.php";

$url		= "http://localhost:8069";
$username	= "admin";
$password	= "1";
$dbname		= "ear1";

/* login */
$common = ripcord::client("$url/xmlrpc/2/common");
$uid = $common->authenticate($dbname, $username, $password, array());
var_dump($uid);

/* create $models object */
$models = ripcord::client("$url/xmlrpc/2/object");

echo "<h2>search academic.course</h2>";

/* search ID partner */
$ids = $models->execute_kw($dbname, $uid, $password, 'academic.course', 'search', 
		array(
			array(
				array('name','=','Java'),
			)
		)
	);
var_dump($ids);

echo "<h2>write Partner with id=$ids[0] </h2>";
$ret = $models->execute_kw($dbname, $uid, $password, 
	'academic.course', 'write',
    array(
    	$ids, 
    	array('name'=>"Java Fundamental")
   	)
);
var_dump($ret);
