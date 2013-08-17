<?php
namespace SimpleWeb;

abstract class SimpleWeb
{
	abstract protected function proxySet($host, $port, $user, $pass);
	abstract protected function get($url);
	//abstract protected function 
	protected $proxy = Array();
	protected $items = Array();
	/**
	 * Build returns a new instance of the correct subclass
	 */
	 
	public static function build($mode)
	{
		if ($mode == "curl") { return new SimpleCurl; }
	}
	/**
	 * Build returns a new instance of the correct subclass
	 */
	 
	public static function clear()
	{
		$this->$items = Array();
	}
	/**
	 * Load (auto-set) proxy settings from environment variables.
	 * Lifed shamelessly from Browscap.php
	 */
	protected function proxyDetect()
	{
        $wrappers = array('http', 'https', 'ftp');

        foreach ($wrappers as $wrapper) {
            $url = getenv($wrapper.'_proxy');
            if (!empty($url)) {
                $params = array_merge(array(
                    'port'  => null,
                    'user'  => null,
                    'pass'  => null,
                    ), parse_url($url));
                $this->proxySet($params['host'], $params['port'], $params['user'], $params['pass']);
            }
        }
	}
}