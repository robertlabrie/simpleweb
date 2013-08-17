<?php
namespace SimpleWeb;
class SimpleWebException extends \Exception
{ 
	public $httpCode;
	public $shortMessage;
	public function __construct($message, $code = 0, Exception $previous = null, $httpCode = 0, $shortMessage = null)
	{
		$this->httpCode = $httpCode;
		$this->shortMessage = $shortMessage;
		parent::__construct($message, $code, $previous);
	}
}