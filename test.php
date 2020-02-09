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

echo "<h2>search and then read academic.course</h2>";

/* search ID partner */
$ids = $models->execute_kw($dbname, $uid, $password, 'academic.course', 'search', 
		array(
			array(
				array('name','=','Java'),
			)
		)
	);
var_dump($ids);

/* read record by ID */
$records = $models->execute_kw($dbname, $uid, $password, 'academic.course', 'read', array($ids));
echo "<br/>";
foreach ($records as $key => $value) {
	echo $value['name'] . "<br/>";
	echo $value['description'] . "<br/>";
}

/* search_read */
$records = $models->execute_kw($dbname, $uid, $password, 'academic.course', 'search_read', 
		array(
			array(
				array('name','ilike','java'),
			)
		)
	);

echo "<br/>";
foreach ($records as $key => $value) {
	echo $value['name'] . "<br/>";
	echo $value['responsible_id'][1] . "<br/>";
}