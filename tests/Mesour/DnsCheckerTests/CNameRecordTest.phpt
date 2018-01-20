<?php

namespace Mesour\DnsCheckerTests;

use Mesour\DnsProvider\DnsRecord;
use Tester\Assert;

require_once __DIR__ . '/../../bootstrap.php';
require_once __DIR__ . '/BaseTestCase.php';

class ARecordTest extends BaseTestCase
{

	public function testDefault()
	{
		$checker = $this->createChecker($this->getDnsRows());
		$records = $checker->getDnsRecordSet('example.com');

		Assert::false($records->isEmpty());
		Assert::count(1, $records);
		Assert::type(DnsRecord::class, $records[0]);
		Assert::same($this->getExpectedRows(), $records->toArray());
	}

	private function getExpectedRows(): array
	{
		return [
			[
				'type' => 'A',
				'name' => 'example.com',
				'content' => '216.58.201.78',
				'ttl' => 34,
			],
		];
	}

	private function getDnsRows(): array
	{
		return [
			[
				'host' => 'example.com',
				'class' => 'IN',
				'ttl' => 34,
				'type' => 'A',
				'ip' => '216.58.201.78',
			],
		];
	}

}

$test = new ARecordTest();
$test->run();
