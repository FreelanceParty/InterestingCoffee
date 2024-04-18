<?php

namespace App\Models;

use App\Models\Abstracts\AModel;

/**
 * Class Statistic
 * @property string $category
 * @property array  $list
 * @package App\Models
 */
class Statistic extends AModel
{
	/*** @var string[] */
	protected $casts = [
		'list' => 'array',
	];

	/**
	 * @param string $key
	 * @param int    $value
	 * @return void
	 */
	public function updateValueByKey(string $key, int $value): void
	{
		$list = $this->getList();
		if (in_array($key, $list, TRUE)) {
			$list[$key] = $this->getValueByKey($key) + $value;
		} else {
			$list[$key] = $value;
		}
		$this->setList($list);
		$this->save();
	}

	/**
	 * @param array $values
	 * @return void
	 */
	public function updateValues(array $values): void
	{
		foreach ($values as $key => $value) {
			$this->updateValueByKey($key, $value);
		}
	}

	/**
	 * @param string $key
	 * @return int
	 */
	public function getValueByKey(string $key): int
	{
		return ($this->getList())[$key] ?? 0;
	}

	/*** @return string */
	public function getCategory(): string
	{
		return $this->category;
	}

	/**
	 * @param string $category
	 * @return void
	 */
	public function setCategory(string $category): void
	{
		$this->category = $category;
	}

	/*** @return array */
	public function getList(): array
	{
		return $this->list ?? [];
	}

	/**
	 * @param bool|NULL $reversed
	 * @return array
	 */
	public function getSortedList(?bool $reversed = FALSE): array
	{
		$list = $this->getList() ?? [];
		$reversed ? arsort($list) : asort($list);
		return $list;
	}

	/**
	 * @param array $list
	 * @return void
	 */
	public function setList(array $list): void
	{
		$this->list = $list;
	}

}
