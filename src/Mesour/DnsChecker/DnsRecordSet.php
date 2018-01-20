<?php

namespace Mesour\DnsProvider;

class DnsRecordSet implements \Iterator, \Countable, \ArrayAccess
{

	/**
	 * @var IDnsRecord[]
	 */
	private $dnsRecords;

	/**
	 * @var int
	 */
	private $position = 0;

	public function __construct(array $dnsRecords)
	{
		$this->dnsRecords = $dnsRecords;
	}

	public function getRecords()
	{
		return $this->dnsRecords;
	}

	public function isEmpty()
	{
		return count($this->dnsRecords) === 0;
	}

	public function toArray(): array
	{
		$out = [];
		foreach ($this->dnsRecords as $dnsRecord) {
			$out[] = $dnsRecord->toArray();
		}
		return $out;
	}

	public function count()
	{
		return count($this->dnsRecords);
	}

	public function rewind()
	{
		$this->position = 0;
	}

	public function current()
	{
		return $this->dnsRecords[$this->position];
	}

	public function key()
	{
		return $this->position;
	}

	public function next()
	{
		++$this->position;
	}

	public function valid()
	{
		return isset($this->dnsRecords[$this->position]);
	}

	public function offsetExists($offset)
	{
		return isset($this->dnsRecords[$offset]);
	}

	public function offsetGet($offset)
	{
		return isset($this->dnsRecords[$offset]) ? $this->dnsRecords[$offset] : null;
	}

	public function offsetSet($offset, $value)
	{
		throw new \RuntimeException('DnsRecordSet is read only.');
	}

	public function offsetUnset($offset)
	{
		throw new \RuntimeException('DnsRecordSet is read only.');
	}

	public function __clone()
	{
		$this->rewind();
	}

}
