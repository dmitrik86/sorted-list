<?php
namespace SortedList\Tests;

use PHPUnit\Framework\TestCase;
use SortedList\SortedList;

class SortedListTest extends TestCase
{
    public function testItemExists()
    {
        $items = [3, 7, 1, 4, 5, 1, 2, 3, 7];
        $actions = ['put', 'put', 'put', 'put', 'put', 'exists', 'exists', 'exists', 'exists'];
        $results = [null, null, null, null, null, true, false, true, true];
        $this->runTests(new SortedList(), $actions, $items, $results);
    }

    public function testLeftPosition()
    {
        $items = [3, 7, 1, 4, 5, 3, 1, 0, 2, 3, 7, 8];
        $actions = ['put', 'put', 'put', 'put', 'put', 'put', 'leftPosition', 'leftPosition', 'leftPosition', 'leftPosition', 'leftPosition', 'leftPosition'];
        $results = [null, null, null, null, null, null, 0, 0, 1, 1, 5, 6];
        $this->runTests(new SortedList(), $actions, $items, $results);
    }

    public function testRightPosition()
    {
        $items = [3, 7, 1, 4, 5, 3, 1, 0, 2, 3, 7, 8];
        $actions = ['put', 'put', 'put', 'put', 'put', 'put', 'rightPosition', 'rightPosition', 'rightPosition', 'rightPosition', 'rightPosition', 'rightPosition'];
        $results = [null, null, null, null, null, null, 1, 0, 1, 3, 6, 6];
        $this->runTests(new SortedList(), $actions, $items, $results);
    }

    public function testMinMaxValues()
    {
        $items = [3, 7, 1, 4, 5, 8, 11, -12, -7, 11, null, null, null, null, null, null, null, null, null, null];
        $actions = ['put', 'put', 'put', 'put', 'put', 'put', 'put', 'put', 'put', 'put', 'getMin', 'popMin', 'popMin', 'getMin', 'getMax', 'popMax', 'getMax', 'popMax', 'getMax', 'popMax'];
        $results = [null, null, null, null, null, null, null, null, null, null, -12, -12, -7, 1, 11, 11, 11, 11, 8, 8];
        $this->runTests(new SortedList(), $actions, $items, $results);
    }

    /**
     * @param SortedList $sortedList
     * @param array      $actions
     * @param array      $values
     * @param int        $actionNumber
     *
     * @return bool|null
     * @throws \Exception
     */
    protected function call(
        SortedList $sortedList,
        array      $actions,
        array      $values,
        int        $actionNumber
    ) {
        switch ($actions[$actionNumber]) {
            case 'put':
                return $sortedList->put($values[$actionNumber]);
            case 'exists':
                return $sortedList->exists($values[$actionNumber]);
            case 'leftPosition':
                return $sortedList->leftPosition($values[$actionNumber]);
            case 'rightPosition':
                return $sortedList->rightPosition($values[$actionNumber]);
            case 'getMin':
                return $sortedList->getMin();
            case 'getMax':
                return $sortedList->getMax();
            case 'popMin':
                return $sortedList->popMin();
            case 'popMax':
                return $sortedList->popMax();
            default:
                throw new \Exception('Invalid test case method.');
        }
    }

    /**
     * @param SortedList $sortedList
     * @param array      $actions
     * @param array      $values
     * @param array      $results
     *
     * @return void
     * @throws \Exception
     */
    protected function runTests(
        SortedList $sortedList,
        array      $actions,
        array      $values,
        array      $results
    ) {
        if (
            ($numberOfItems = count($actions)) !== count($values)
            || count($results) !== $numberOfItems
        ) {
            throw new \Exception('Invalid test case');
        }
        for ($i = 0; $i < $numberOfItems; ++$i) {
            $this->assertEquals(
                $results[$i],
                $this->call(
                    $sortedList,
                    $actions,
                    $values,
                    $i
                )
            );
        }
    }
}