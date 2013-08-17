<?php
namespace SimpleWeb;

abstract class SimpleWeb
{
	abstract protected function proxySet($host, $port, $user, $pass);

	public static function bozo($mode)
	{
		echo "dojo";
	}
	public static function build($mode)
	{
		if ($mode == "curl") { return new SimpleCurl; }
	}
	/**
	 * return an instance of self
	 */
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