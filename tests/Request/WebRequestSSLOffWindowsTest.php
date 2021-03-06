<?php

namespace Rhubarb\Crown\Tests\Request;

use Rhubarb\Crown\Request\WebRequest;

class WebRequestSSLOffWindowsTest extends RequestTestCase
{

	protected $request = null;

	protected function setUp()
	{
		parent::setUp();

		// inject some data for testing and cover the absence of web server-type
		// superglobals in the testing CLI context
		$_SERVER[ 'HTTP_HOST' ] = 'gcdtech.com';
		$_SERVER[ 'SCRIPT_URI' ] = 'http://gcdtech.com/foo';
		$_SERVER[ 'SCRIPT_URL' ] = '/foo';
		$_SERVER[ 'HTTPS' ] = 'off';

		$_GET = [];
		$_POST = [];
		$_FILES = [];
		$_COOKIE = [];
		$_SESSION = [];
		$_REQUEST = [];

		$this->request = new WebRequest();
	}

	protected function tearDown()
	{
		$this->request = null;

		parent::tearDown();
	}

	public function testNoSSL()
	{
		$this->assertFalse( $this->request->IsSSL );
	}
}
