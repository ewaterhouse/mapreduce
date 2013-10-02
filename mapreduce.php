<?php

class MapReduce {

    public $itemsPerThread = 100;

    public static function filter($arry, $func) {
        $result = array();
        foreach ($arry as $item) {
            if ($func($item)) {
                array_push($result, $item);
            }
        }
        return $result;
    }

    public static function map($arry, $func) {
        $result = array();
        foreach ($arry as $item) {
            array_push($result, $func($item));
        }
        return $result;
    }

    public static function reduce($arry, $func, $identity) {
/*        $result = $identity;
        foreach ($arry as $item) {
            $result = $func($item, $result);
        }
        return $result;
 */
        $data = array_chunk($arry, $this->itemsPerThread);
        $threads = [];
        foreach($data as $subarry) {
            $threads[count($threads)] = new ReduceThread($subarry, $func, $identity);
            $threads[count($threads)-1]->start();
        }
        $intermediateresult = [];
        foreach($threads as $thread) {
            $thread->join();
            array_push($intermediateresult, $thread->result);
        }
        if (count($intermediateresult) == 1) {
            return $intermediateresult[0];
        }
        return $this->reduce($intermediateresult, $func, $identity);
    }

}
    class ReduceThread extends Thread {
        private $data;
        private $func;
        public $result;

        public function __construct($data, $func, $identity) {
            $this->data = $data;
            $this->func = $func;
            $this->result = $identity;
        }

        public function run() {
            foreach ($arry as $item) {
                $this->result = $func($item, $this->result);
            }
        }
    }
?>
