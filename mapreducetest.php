<?php
require_once "mapreduce.php";

class MapReduceTest extends PHPUnit_Framework_TestCase {

    public function testFilter() {
        $data = [1,2,3,4,5];
        $result = MapReduce::filter($data, function($i) { return $i >3; } );
        $this->assertEquals([4,5], $result);
    }

    public function testMap() {
        $data = [1,2,3,4,5];
        $result = MapReduce::map(function($i) { return $i*2; }, $data);
        $this->assertEquals([2,4,6,8,10], $result);
    }

    public function testReduce() {
        $data = [1,2,3,4,5];
        $result = MapReduce::reduce($data, function($i) { return $i; });
        $this->assertEquals(15, $result);
    }

}
?>

