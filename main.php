<?php


/*
 * Complete the 'carParkingRoof' function below.
 *
 * The function is expected to return a LONG_INTEGER.
 * The function accepts following parameters:
 *  1. LONG_INTEGER_ARRAY cars
 *  2. INTEGER k
 */

class DataFactory
{
    public static function getData($size)
    {
        return self::generateData($size);
    }

    private static function generateData($size)
    {
        $result = [];
        for ($i = 0; $i < $size; $i++)
        {
            $result[] = self::createRecord();
        }
        return $result;
    }

    private static function createRecord()
    {
        return ["item " . rand(1, 99), (string)rand(1, 99), (string)rand(1, 99)];
    }


}


class Main
{
    private array $items;
    private int   $sortParameter;
    private int   $sortOrder;
    private int   $itemsPerPage;
    private int   $pageNumber;

    public function __construct(array $items, int $sortParameter, int $sortOrder, int $itemsPerPage, int $pageNumber)
    {
        $this->items = $items;
        $this->sortParameter = $sortParameter;
        $this->sortOrder = $sortOrder;
        $this->itemsPerPage = $itemsPerPage;
        $this->pageNumber = $pageNumber;
    }

    public function fetchItemsToDisplay()
    {
        print_r($this->items);
        $this->sortItems();
        $pages = $this->paginateItems();
        return $pages[$this->pageNumber];
    }

    private function sortItems()
    {
        usort($this->items, function ($a, $b) {
            return $this->sortOrder ?
                $b[$this->sortParameter] <=> $a[$this->sortParameter] : // sortOrder = 1 ... from high to low.
                $a[$this->sortParameter] <=> $b[$this->sortParameter]; // sortOrder = 0 ... from low to high.
        });
    }

    private function paginateItems()
    {
        return array_chunk($this->items, $this->itemsPerPage);
    }
}

$array = DataFactory::getData(5);
$main = new Main($array, 0, 1, 2, 0);

echo print_r($main->fetchItemsToDisplay());