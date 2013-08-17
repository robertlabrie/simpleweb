<?php
namespace SimpleWeb;
class SimpleCurl extends SimpleWeb
{
	private $ch;
	public function __construct()
	{
		$this->ch = curl_init();
	}
	public function proxySet($host, $port, $user, $pass)
	{
		$this->proxy['host'] = $host;
		$this->proxy['port'] = $port;
		$this->proxy['user'] = $user;
		$this->proxy['pass'] = $pass;
		$url = "http://$user:$pass@$host:$port";
		curl_setopt($this->ch,CURLOPT_PROXY,$url);
	}
	public function get($url)
	{
		curl_setopt($this->ch,CURLOPT_URL,$url);
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
		$data = curl_exec($this->ch);
		return $data;
	}
}