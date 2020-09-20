<?php

require(dirname(__FILE__).'/NextCloudUtils.php');

$groups = array(
	array(
		'groupid'   => 'GRP-TEST-01',
	),
	array(
		'groupid'   => 'GRP-TEST-02',
	),

);

try{
	foreach($groups as $group){
		echo ">>> add group : ".$group['groupid'].PHP_EOL; 
		$result = create_group($group);
		echo ">>>>>> done".PHP_EOL; 
	}

}catch(Exception $e){
	echo '*** Caught exception: '.$e->getMessage().PHP_EOL;
}

/*

Status codes:
=============

100 - successful
101 - invalid input data
102 - group already exists
103 - failed to add the group

*/

