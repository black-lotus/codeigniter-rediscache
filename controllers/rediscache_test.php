<?php

/**
 * Test for rediscache 
 */
if (! defined('BASEPATH')) exit('No direct script access');

class Rediscache_test extends CI_Controller {

	public function index () {
		$this->load->library('unit_test');
		$this->load->library('redis');
		$this->load->library('credis');
		$this->unit->use_strict(TRUE);

		// string
		$testVar = 'testvar';
		$this->unit->run($this->credis->set('rc.key', $testVar, 10000), true, 'set string');
		$this->unit->run($this->credis->get('rc.key'), $testVar, 'get string');
		var_dump($this->credis->get('rc.key'));
		$this->unit->run($this->credis->del('rc.key'), true, 'del string');

		// array
		$testArr = array(
			'hoge' => 'foo',
			'fuga' => 'bar'
		); 
		$this->unit->run($this->credis->set('rc.key', $testArr, 10000), true, 'set array');
		$this->unit->run($this->credis->get('rc.key'), $testArr, 'get array');
		$this->unit->run($this->credis->del('rc.key'), true, 'del array');

		// nested array with space
		$testArr = array(
			'hoge fuga' => 'foo bar test',
			'hoge2' 	=> array(
				'foo bar key 2' => 'foo bar value 2'
			)
		); 
		$this->unit->run($this->credis->set('rc.key', $testArr, 10000), true, 'set nested array with space');
		$this->unit->run($this->credis->get('rc.key'), $testArr, 'get nest array with space');
		$this->unit->run($this->credis->del('rc.key'), true, 'del array');


		// object
		$testObj = new Testobj;
		$this->unit->run($this->credis->set('rc.key', $testObj, 10000), true, 'set object');
		$this->unit->run($this->credis->get('rc.key')->var, $testObj->var, 'get object');
		$this->unit->run($this->credis->del('rc.key'), true, 'del object');

		// function (should be false)
		$testFunc = function(){};
		$this->unit->run($this->credis->set('rc.key', $testFunc, 10000), false, 'set function (should be false)');
		$this->unit->run($this->credis->get('rc.key'), false, 'get function (should be false)');

		// resource (should be false)
		$testRes = curl_init();
		$this->unit->run($this->credis->set('rc.key', $testRes, 10000), false, 'set resource (should be false)');
		$this->unit->run($this->credis->get('rc.key'), false, 'get resource (should be false)');
		curl_close($testRes);

		echo $this->unit->report();

	}
	
	public function credis()
	{
		$arr = array(
			'1' => 'satu',
			'2' => 'dua',
			'3' => 'tiga',
			'4' => 'empat',
			'5' => 'lima'
		);
		$redis = $this->credis->get('rc.test');
		if(!$redis){
			$this->credis->set('rc.test', $arr);
			$redis = $arr;
		}
		var_dump($redis);
	}
	
	public function getKeys()
	{
		var_dump($this->credis->getKeys());
	}

}

class Testobj {
	public $var = 'var';
}

