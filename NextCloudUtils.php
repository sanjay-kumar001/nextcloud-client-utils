<?php
/**
 * NextCloudUtils-PHP
 *
 * @author     Sanjay Kumar <sanjay.kumar001@gmail.com>
 * @copyright  2020 Sanjay Kumar, India
 * @license    https://opensource.org/licenses/MIT MIT 
 *
 * Licensed under The GPL v3 License
 * Redistributions of files must retain the above copyright notice.
 *
 */

require(dirname(__FILE__).'/Config.php');

function create_user($user){
	$config = Config::get();
	$endpoint = $config->ocs_endpoint.'users';
	return _do_curl($endpoint, $config->basic_auth, $user);
}

function create_group($group){
	$config = Config::get();
	$endpoint = $config->ocs_endpoint.'groups';
	return _do_curl($endpoint, $config->basic_auth, $group);
}

function _do_curl($endpoint, $basic_auth, $params){
	$headers = array(
	    'Accept: application/json',
	    'OCS-APIRequest:true',
	);
	$endpoint = $endpoint.'?format=json';
	$user_pwd = $basic_auth->user.':'.$basic_auth->pwd;
	$ch = curl_init($endpoint);

	curl_setopt($ch,CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	curl_setopt($ch, CURLOPT_USERPWD, $user_pwd);
	curl_setopt($ch,CURLOPT_POST, true);
	curl_setopt($ch,CURLOPT_POSTFIELDS, $params);
	curl_setopt($ch,CURLOPT_CUSTOMREQUEST, 'POST');
	curl_setopt($ch,CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);

	$response = curl_exec($ch);
	curl_close($ch);
	$response = json_decode($response);
	if ($response){ 
		$meta = $response->ocs->meta;
		$status_code = $meta->statuscode;
		if($status_code <> 100 && $status_code <> 102){
			$err_message = $meta->statuscode.' : '.$meta->status.' : '.$meta->message;
			throw new Exception($err_message);
		}elseif($status_code == 102){
			echo $meta->statuscode.' : '.$meta->status.' : '.$meta->message.PHP_EOL;
		}
	}
	return $response;
}

