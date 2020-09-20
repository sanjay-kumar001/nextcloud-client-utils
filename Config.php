<?php 
/**
 * NextCloud : Config
 *
 * @author     Sanjay Kumar <sanjay.kumar001@gmail.com>
 * @copyright  2020 Sanjay Kumar, India
 * @license    https://opensource.org/licenses/MIT MIT 
 *
 * Licensed under The GPL v3 License
 * Redistributions of files must retain the above copyright notice.
 *
 */

class Config {

    static function get()
    {
	$config = new stdClass;
	$config->base_url = 'http://nextcloud.local'; //add server details
	$config->basic_auth = (object) array('user'=>'user', 'pwd'=>'******');
	$config->ocs_endpoint = $config->base_url.'/ocs/v1.php/cloud/';
	return $config;
    }
}
