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

/* search ID partner Agus*/
$partner1_id = $models->execute_kw($dbname, $uid, $password, 'res.partner', 'search', 
		array(
			array(
				array('name','=','Azure Interior'),
			)
		)
	);
/* search ID partner Budi*/
$partner2_id = $models->execute_kw($dbname, $uid, $password, 'res.partner', 'search', 
		array(
			array(
				array('name','=','Deco Addict'),
			)
		)
	);
/* search ID session */
$ids = $models->execute_kw($dbname, $uid, $password, 'academic.session', 'search', 
		array(
			array(
				array('name','=','Sess/001/sion'),
			)
		)
	);
var_dump($ids);
echo "<h2>write attendee_ids on academic.session</h2>";
$ret = $models->execute_kw($dbname, $uid, $password, 'academic.session', 'write', 
		array(
			$ids,
			array(
				'duration'=>10,
				'seats'=>20,
				'attendee_ids' =>array(
					array(0,0,array(
						'partner_id'=>$partner1_id[0],
						'name'=>"01")),
					array(0,0,array(
						'partner_id'=>$partner2_id[0],
						'name'=>"02"))
					)
				)
			)
		);
var_dump($ret);