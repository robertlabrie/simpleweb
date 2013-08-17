<?php
/*
A simple PHP class. It doesn't try to be a hero.

*/

require_once("SimpleCurlDoc.php");
class SimpleCurl
{
	private $ch;		//the imfamous $ch
	private $cookiejar;	//we're going to store cookies
	public $docs = Array();
	
	public function __construct()
	{
		//test for curl
		if (!function_exists("curl_init")) { throw new Exception('cURL is not installed.'); }
		//throw new Exception('test');
		
		//initialize the curl object
		$this->ch = curl_init();
		
		//initialize some stuff
		curl_setopt($this->ch,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($this->ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');		
	}
	public function goExternal()
	{
		//setup stuff for hitting external sites
		$this->setProxyDefault();
		$this->setCookieFile();
		$this->setRedirect(5);
		
	}
	public function get($url)
	{
		$d = new SimpleCurlDoc($this->ch);
		$res = $d->get($url);
		array_push($this->docs,$d);
		return $res;
	}
	public function post($url,$data)
	{
		$d = new SimpleCurlDoc($this->ch);
		$res = $d->post($url,$data);
		array_push($this->docs,$d);
		return $res;
	}
	public function setRedirect($max = null)
	{
		if (!$max) { $max = 99999999999; }	//default to an absurd, harmful number
		$this->setOpt(CURLOPT_MAXREDIRS,$max);
		$this->setOpt(CURLOPT_FOLLOWLOCATION,true);
		curl_setopt($this->ch,CURLOPT_MAXREDIRS,$max);
		curl_setopt($this->ch,CURLOPT_FOLLOWLOCATION,true);
	}
	public function setProxyDefault()
	{
		//use the OS proxy if set
		$proxy = getenv("http_proxy");
		if ($proxy) { $this->setProxy($proxy); }
	}
	public function setProxy($url)
	{
		curl_setopt($this->ch,CURLOPT_PROXY,$url);
	}
	public function setOpt($key,$value)
	{
		curl_setopt($this->ch,$key,$value);
	}
	public function setCookieFile($file = null)
	{
		//setup cookies
		if (!$file) { $file = "/tmp/" . uniqid ();	}	//use a random file if none is given

		$this->cookiejar = $file;
		curl_setopt($this->ch,CURLOPT_COOKIEFILE,$file);
		curl_setopt($this->ch,CURLOPT_COOKIEJAR,$this->cookiejar);
	}
}