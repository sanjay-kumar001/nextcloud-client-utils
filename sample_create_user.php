<?php

require(dirname(__FILE__).'/NextCloudUtils.php');

$users = array(
	array(
		'userid'   => 'test01',
		'displayName' => 'Test 01',
		'password' => 'test01@1234',
		'email' => 'test01@example.com',
		'groups[]' => 'GRP-TEST-01',
	),
	array(
		'userid'   => 'test02',
		'displayName' => 'Test 02',
		'password' => 'test02@1234',
		'email' => 'test02@example.com',
		'groups[]' => 'GRP-TEST-02',
	),
);

try{
	foreach($users as $user){
		echo ">>> add user : ".$user['userid'].PHP_EOL; 
		$result = create_user($user);
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
102 - username already exists
103 - unknown error occurred whilst adding the user
104 - group does not exist
105 - insufficient privileges for group
106 - no group specified (required for subadmins)
107 - all errors that contain a hint - for example “Password is among the 1,000,000 most common ones. Please make it unique.” (this code was added in 12.0.6 & 13.0.1)
108 - password and email empty. Must set password or an email
109 - invitation email cannot be send

success reuslt
==============

class stdClass#10 (1) {
  public $ocs =>
  class stdClass#8 (2) {
    public $meta =>
    class stdClass#7 (5) {
      public $status =>
      string(2) "ok"
      public $statuscode =>
      int(100)
      public $message =>
      string(2) "OK"
      public $totalitems =>
      string(0) ""
      public $itemsperpage =>
      string(0) ""
    }
    public $data =>
    class stdClass#9 (1) {
      public $id =>
      string(6) "test02"
    }
  }
}


*/

