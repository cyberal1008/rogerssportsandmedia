<?php
/**
 * WordPress Environment-specific Configuration Loader
 * @author Joe Hohertz <joe.hohertz@rci.rogers.com>
 * @author Weston Ruter <weston@xhtmlized.com>
 * @version 1.3
 *
 * This configuration loader iterates over all of the *.env.php files listed in
 * the provided directory; these files each must take the form of "<?php return
 * array(...) ?>". There should be one default.env.php which has options that
 * are common to all environments, but then there can be environment-specific
 * configurations which are activated when the configuration has a
 * "active_test()" function provided and it returns true. The
 * environment-specific configurations are merged in with the defaults.
 *
 * =Changelog=
 * 2011-07-25: Allowing the env to be specified in the constructor to bypass looking for config/active-env
 * 2011-08-01: Ensuring that DOMAIN_CURRENT_SITE gets set properly.
 * 2011-12-20: Ensuring table_prefix is the same across all environments.
 * 2012-04-17: import to RDM core, and subsequent changes
 * 
 */

class RDM_WordPress_Config {
	public $dir;
	public $config;
	public $active_env = null;
	
	function __construct($dir, $active_env = null){
		$this->dir = $dir;
		$this->active_env = $active_env;
		$this->_load();
	}
	
	/**
	 * Load each of the configs for each of the environments
	 */
	protected function _load(){
		// Get the active env if it hasn't been set; this allows the env to be
		// specified with code in wp_config.php
		if(is_null($this->active_env)){
			if(!file_exists("{$this->dir}/active-env")){
				throw new Exception("Missing required file 'active-env' in the config directory. This text file must contain the name of the currently active environment.");
			}
			$this->active_env = trim(file_get_contents("{$this->dir}/active-env"));
			if(!file_exists("{$this->dir}/{$this->active_env}.env.php")){
				throw new Exception("Configuration file for '{$this->active_env}' environment doesn't exist at `{$this->dir}/{$this->active_env}.env.php`.");
			}
		}
		
		// Load the default configuration
		$default_config = array();
		if(file_exists("{$this->dir}/default.env.php")){
			$default_config = require("{$this->dir}/default.env.php");
		}
		
		$config_file = "{$this->dir}/{$this->active_env}.env.php";
		$env_name = "{$this->active_env}";
		$env_config = require($config_file);

		if( isset($env_config['table_prefix']) ){
			throw new Exception("You cannot override the default table_prefix.");
		}
			
		// Save the config after merging it with default
		$this->config = (object)array_merge($default_config, $env_config);
	}
	
	/**
	 * Load the configuration constants and variables into the environment
	 */
	function extract(){
		
		foreach($this->config as $config_name => $config_value){
			// Make a global variable
			if(preg_match('/^[a-z0-9_]+$/', $config_name)){
				global $$config_name;
				$$config_name = $config_value;
			}
			// Make a constant
			else if(preg_match('/^[A-Z0-9_]+$/', $config_name)){
				define($config_name, $config_value);
			}
		}
		
		// Not sure if this is even needed, but might as well
		if( !defined('DOMAIN_CURRENT_SITE') ){
			if( empty($domain_registry) ){
				throw new Exception( 'If you do not define DOMAIN_CURRENT_SITE, you must popualte $domain_registry' );
			}
			//define( 'DOMAIN_CURRENT_SITE', $domain_registry[1] ); // 1 is the index for the (first) WP network site
		}
	}
	
}

