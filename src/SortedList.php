<?php
namespace SortedList;

class SortedList
{
    protected array $list = [];

    /**
     * Get sorted list.
     *
     * @return array
     */
    public function get(): array
    {
        return $this->list;
    }

    /**
     * Add new value to sorted list.
     * Time complexity: O(log(n)).
     *
     * @param int|float $value
     *
     * @return void
     */
    public function put($value): void
    {
        $position = $this->leftPosition($value);
        $this->list = array_merge(
            array_slice($this->list, 0, $position),
            [$value],
            array_slice($this->list, $position)
        );
    }

    /**
     * Get left position of value in sorted list.
     * Time complexity: O(log(n)).
     *
     * @param int|float $value
     *
     * @return int
     */
    public function leftPosition($value): int
    {
        if (($numberOfItems = count($this->list)) === 0) {
            return 0;
        }
        $left = 0;
        $right = count($this->list) - 1;
        while ($left <= $right) {
            $middle = (int)floor(($left + $right) / 2);
            if ($middle === 0 && $this->list[$middle] >= $value) {
                return 0;
            } elseif ($middle === $numberOfItems - 1 && $this->list[$middle] < $value) {
                return $numberOfItems;
            } elseif ($this->list[$middle] >= $value && $this->list[$middle - 1] < $value) {
                return $middle;
            } elseif ($this->list[$middle] < $value) {
                $left = $middle + 1;
            } else {
                $right = $middle - 1;
            }
        }
    }

    public function rightPosition($value): int
    {
        if (($numberOfItems = count($this->list)) === 0) {
            return 0;
        }
        $left = 0;
        $right = count($this->list) - 1;
        while ($left <= $right) {
            $middle = (int)floor(($left + $right) / 2);
            if ($middle === 0 && $this->list[$middle] > $value) {
                return 0;
            } elseif ($middle === $numberOfItems - 1 && $this->list[$middle] <= $value) {
                return $numberOfItems;
            } elseif ($this->list[$middle] > $value && $this->list[$middle - 1] <= $value) {
                return $middle;
            } elseif ($this->list[$middle] <= $value) {
                $left = $middle + 1;
            } else {
                $right = $middle - 1;
            }
        }
    }

    /**
     * Check if element exists.
     * Time complexity: O(log(n)).
     *
     * @param int|float $value
     *
     * @return bool
     */
    public function exists($value): bool
    {
        if (count($this->list) === 0) {
            return false;
        }
        $left = 0;
        $right = count($this->list) - 1;
        while ($left <= $right) {
            $middle = floor(($left + $right) / 2);
            if ($this->list[$middle] > $value) {
                $right = $middle - 1;
            } elseif ($this->list[$middle] < $value) {
                $left = $middle + 1;
            } else {
                return true;
            }
        }
        return false;
    }

    /**
     * Get minimum value of sorted list.
     * Time complexity: O(1).
     *
     * @return int|float|null
     */
    public function getMin()
    {
        if (count($this->list) === 0) {
            return null;
        }
        return $this->list[0];
    }

    /**
     * Get maximum value of sorted list.
     * Time complexity: O(1).
     *
     * @return int|float|null
     */
    public function getMax()
    {
        if (count($this->list) === 0) {
            return null;
        }
        return $this->list[count($this->list) - 1];
    }

    /**
     * Extract minimum value of sorted list.
     * Time complexity: O(1).
     *
     * @return int|float|null
     */
    public function popMin()
    {
        return array_shift($this->list);
    }

    /**
     * Extract maximum value of sorted list.
     * Time complexity: O(1).
     *
     * @return int|float|null
     */
    public function popMax()
    {
        return array_pop($this->list);
    }
}