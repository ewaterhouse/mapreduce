<?php
require_once "mapreduce.php";


class MapReduceTest extends PHPUnit_Framework_TestCase {

/*
    public function testFilter() {
        $data = [1,2,3,4,5];
        $result = MapReduce::filter($data, function($i) { return $i >3; } );
        $this->assertEquals([4,5], $result);
    }

    public function testMap() {
        $data = [1,2,3,4,5];
        $result = MapReduce::map($data, function($i) { return $i*2; });
        $this->assertEquals([2,4,6,8,10], $result);
    }

    public function testReduce() {
        $data = [1,2,3,4,5];
        $result = MapReduce::reduce($data, function($i) { return $i; }, 0);
        $this->assertEquals(15, $result);
    }
 */

    protected function runner($uut, $args, $returnval) {
        $result = call_user_func_array($uut, $args);
        $this->assertEquals($returnval, $result);
    }

    public function testGeneric() {
        $this->runner(['MapReduce', 'filter'], [[1,2,3,4,5], function($i) { return $i>3;}], [4,5]);
        $this->runner(['MapReduce', 'map'],    [[1,2,3,4,5], function($i) { return $i*2;}], [2,4,6,8,10]);
        $this->runner(['MapReduce', 'reduce'], [[1,2,3,4,5], function($i, $acc) { return $i+$acc;}, 0], 15);
        $this->runner(['MapReduce', 'filter'], [['A', 'F'], function($i) { return $i>'C';}], ['F']);
        $this->runner(['MapReduce', 'reduce'], [[1,2,3,4,5], function($i, $acc) { return $i*$acc;}, 1], 120);
    }

}
?>

