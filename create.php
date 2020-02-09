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

echo "<h2>create course</h2>";

$id = $models->execute_kw($dbname, $uid, $password, 'academic.course','create',
	array(
		array(
			'name'			=>"PHP XMLRPC",
			'description'	=>"Integrasi PHP dengan Odoo",
		),
	)
);
var_dump($id);