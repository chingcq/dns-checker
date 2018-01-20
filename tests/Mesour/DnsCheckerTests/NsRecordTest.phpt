<?php

namespace Mesour\DnsCheckerTests;

use Mesour\DnsProvider\DnsRecord;
use Tester\Assert;

require_once __DIR__ . '/../../bootstrap.php';
require_once __DIR__ . '/BaseTestCase.php';

class PtrRecordTest extends BaseTestCase
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
				'type' => 'PTR',
				'name' => 'example.com',
				'content' => 'test.example.com',
				'ttl' => 300,
			],
		];
	}

	private function getDnsRows(): array
	{
		return [
			[
				'host' => 'example.com',
				'class' => 'PTR',
				'ttl' => 300,
				'type' => 'PTR',
				'target' => 'test.example.com',
			],
		];
	}

}

$test = new PtrRecordTest();
$test->run();
