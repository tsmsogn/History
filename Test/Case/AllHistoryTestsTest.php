<?php
class AllHistoryTestsTest extends PHPUnit_Framework_TestSuite {

/**
 * suite
 *
 * @return CakeTestSuite
 */
	public static function suite() {
		$suite = new CakeTestSuite('All History tests');
		$suite->addTestDirectoryRecursive(CakePlugin::path('History') . 'Test' . DS . 'Case' . DS);
		return $suite;
	}

}
