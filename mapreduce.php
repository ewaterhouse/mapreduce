<?php

class MapReduce {

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
        $result = $identity;
        foreach ($arry as $item) {
            $result = $func($item, $result);
        }
        return $result;
    }

}
?>
