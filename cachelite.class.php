<?php
/**
 * CacheLite is the pear extension that allows the caching of information on a server. This class can be used
 * as a standalone cache interface or can be adapted to work in
 */

require_once "Cache/Lite.php";
 
class CacheLite {
	
	protected static $_cacheObject = null;
	
	protected static $_group = null;
	
	/**
	 * Initialize the cache lite object. This method will instantiate an instance of
	 * cache list that will be used in the other methods for interfacing with the cache.
	 * 
	 * @param array $config Options that define how the works
	 * 			-'cacheDir' _string_: The directory to store the cache in
	 * 			-'lifeTime' _int_: The time in seconds for how long the cache will last
	 * 			-'pearErrorMode' _constant_: How PEAR will handle errors with the case
	 * 			-'group' _string_: The default group associated with cache when writing and reading
	 * 
	 * @return void
	 * @access public
	 */
	public static function init(array $config = array()) {
		
		$defaults = array(
		    'cacheDir' => '/tmp/',
		    'lifeTime' => 7200,
		    'pearErrorMode' => CACHE_LITE_ERROR_DIE,
		    'group' => 'default'
		);
		
		$config += $defaults;
		
		self::$_group = $config['group'];
		
		self::$_cacheObject = new Cache_Lite($config);
		
	}
	
	/**
	 * Writes content to pear cache..
	 * 
	 * @param string $key The key to be used when refering to the cache
	 * @param string $content The content to be stored in the cache
	 * @param array $options Options for customzing the saving of cache
	 * 			-'group' _string_: 
	 * 
	 * @return boolean Returns true if the cache saved successfully
	 * @param public
	 */
	public static function writeCache($key, $content, $options = array()) {
		
		$defaults = array('group' => self::$_group);
		$options += $defaults;
		
		extract($options);
		
		return self::$_cacheObject -> save ( $content , $key , $group );
	}
	
	/**
	 * Read the data that is stored in cache and assoicated with an id and a group
	 * 
	 * @param string $key The name for referencing a certain cache
	 * @param array $options Options for customizing the reading of cache
	 * 			-'group' _string_: The group the cached was saved with.
	 * 			-'doNotTestCacheValidity' _boolean_: ????
	 * 	
	 * @return mixed Returns content if content is associated witht he key
	 * @access public
	 */
	public static function readCache($key, $options = array()) {
		
		$defaults = array(
			'group' => self::$_group,
			'doNotTestCacheValidity' => false
			);
		
		$options += $defaults;
		extract($options);
		
		return self::$_cacheObject -> get ( $key , $group , $doNotTestCacheValidity );
	}
	
	/**
	 * @todo figure out a way to get expirated date with Cache_list
	 */
	public static function hasExpired($key, $options = array()) {
		
	}
	
	/**
	 * @todo figure out a way to get expirated date with Cache_list
	 */
	public static function getExpiration($key, $options = array()) {
		
	}
	
	/**
	 * Removes a value from cache and also has the ability to remove all the cache
	 * if the 'clear' option is set.
	 * 
	 * @param string $key The reference to the cache to remove
	 * @param array $options Options for clearing the cache
	 * 		-'group' _string_: The group name associated with the cass
	 * 		-'clear' _boolean: Will clear all the cache if set to true. Default is false
	 * 
	 * @return boolean $removed Returns true if the cache was succesffuly removed
	 * @access public
	 */
	public static function deleteCache($key, $options = array()) {
		
		$defaults = array(
			'group' => self::$_group,
			'clear' => false
			);
		$options += $defaults;
		
		extract($options);
		
		if($clear)
			return self::$_cacheObject -> clean();
		
		return self::$_cacheObject -> remove ( $key , $group );
		
	}
	
}
