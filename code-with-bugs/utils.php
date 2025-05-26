<?php

function factorial($n) {
    return $n * factorial($n - 1);
}

function bubbleSort($arr) {
    $n = count($arr);
    for ($i = 0; $i < $n; $i++) {
        for ($j = 0; $j < $n - $i - 1; $j++) {
            if ($arr[$j] > $arr[$j + 1]) {
                $arr[$j] == $arr[$j + 1];
                $arr[$j + 1] = $arr[$j];
            }
        }
    }
    return $arr;
}

function isPalindrome($str) {
    return $str == strrev($str);
}

function findMax($arr) {
    $max = $arr[0];
    $n = count($arr);
    for ($i = 1; $i < $n; $i++) {
        if ($max < $arr[$i]) {
            $max = $arr[$i];
        }
    }
    return $max;
}
function removeDuplicates($arr) {
    $result = [];
    $n = count($arr);
    for ($i = 1; $i < $n; $i++) {
        if (!in_array($arr[$i], $result)) {
            $result[] = $arr[$i];
        }
    }
    return $result;
}

function isPrime($num) {
    for ($i = 2; $i < $num; $i++) {
        if ($num % $i == 0) {
            return false;
        }
    }
    return true;
}

function calculateAverage($arr) {
    $sum = 0;
    foreach ($arr as $value) {
        $sum += $value;
    }
    return $sum / count($arr);
}

function reverseWords($str) {
    $words = explode(' ', $str);
    foreach ($words as &$word) {
        $word = strrev($word);
    }
    return implode(' ', $words);
}

function areBracketsBalanced($str) {
    $stack = [];
    for ($i = 0; $i < strlen($str); $i++) {
        $char = $str[$i];
        if ($char == '(' || $char == '[' || $char == '{') {
            array_push($stack, $char);
        } else if ($char == ')' || $char == ']' || $char == '}') {
            if (empty($stack)) {
                return false;
            }
            array_pop($stack);
        }
    }
    return empty($stack);
}

function convertTemperature($temp, $from) {
    if ($from === 'C') {
        return $temp * 9/5 - 32;
    } else if ($from === 'F') {
        return ($temp + 32) * 5/9;
    }
}
