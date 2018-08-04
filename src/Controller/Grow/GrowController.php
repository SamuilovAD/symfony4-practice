<?php

declare(strict_types=1);

namespace App\Controller\Grow;

use App\Entity\Grow;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GrowController extends AbstractController{

    private $userFunctions = [
        'testArray'=>[
            'arrayValues' => 'array_values return all values of array;',
            'arrayChunk' => 'array_chunk split an array into chunks',
            'arrayPop' => 'Pop the element of the end of array',
            'arrayPush' => 'Push one or more elements onto the end of array',
            'arraySearch' => 'Searches the array for a given value and returns the first corresponding key if successful',

        ],
        'testArray2'=>[
            'arrayFlip' => 'array_flip exchange keys with their associated values in an array;',
            'arrayChangeKeyCase' => 'Changers the case of all keys in array',
            'arrayCombine' => '',
            'arrayCountValues'=>'Array count values of array',
            'arrayDiff'=>'Compute the difference  of arrays',
            'arrayDiffKey'=>'Compute the difference of arrays using key comparison',
            'arrayDiffUKey'=>'Compute the difference of arrays using key comparison function',
            'arrayDiffAssoc'=>'Compute the difference of arrays with additional index check',
            'arrayFill'=>'Fill an array with values',
            'arrayFillKeys'=>'Fill an array with values specifying keys',
            'arrayFilter'=>'Filter an array using callback function',
            'arrayKeys'=>'Return all the keys or a subset of the keys of an array',
            'arrayMap'=>'Applies the call back to the elements of given array',
            'arrayPad'=>'Pad array to the specified length with values',
            'arrayReverse'=>'Return an array with elements in reverse order',
            'arrayShift'=>'Shift a value off the beginning of array',
            'arrayUIntersectAssoc' => 'Computes the intersection of arrays with additional index check, compares data by a callback function',
            'arrayUIntersect'=>'Computes the intersection of arrays, using callback function for comparison',
            'arrayUnshift'=>'Prepend one or more elements to the beginning of an array'
        ],
        'testArray2_1'=>[
            'arrayMerge'=>'Merge one or more arrays(rewrite values with the same string keys)',
            'arrayMergeRecursive'=>'Merge one or more arrays recursively',
        ],
        'testArray3'=>[
            'arrayColumn' => 'Return the values from a single column in the input array'
        ],
        'testArray4'=>[],
        'testArray5'=>[
            'arrayProduct'=>'Calculate the product of values in an array',
            'arrayRand'=>'Pick one or more random keys of an array',
            'arrayReduce'=>'Iteratively reduce the array to a single value using a callback function',
            'arrayReplace'=>'Replaces elements from passed arrays into the first array',
            'arraySum'=>'Calculate the sum of values in an array',
            'arrayUnique'=>'Removes duplicate values from an array'
        ]
    ];

    private $testArray5 = [
        1=>1,
        2=>2,
        3=>5,
        4=>4,
        5=>5
    ];

    private $testArray = [
        0.1 => "1",
        0.33 => 3,
        "-8" => 'key string',
        true => 'boolean key',
        null => 'null key',
        'a' => 'test A',
        'b' => 'test B',
        'c' => 'test C',
        'd' => [
            'e' => 'test E',
            'f' => 'test F'
        ]
    ];

    private $testArray2 = [
        7 => "test7",
        8 => "test8",
        9 => "test8",
        10 => "test10",
        11 => "test11",
    ];
    private $testArray2_1 = [
        1234 => "test7",
        12 => "test12",
        9 => "tEst8",
        3 => "test3",
        'd' => "test11_@",
    ];

    private $testArray3 = [
        [
            'id' => 2135,
            'first_name' => 'John',
            'last_name' => 'Doe',
        ],
        [
            'id' => 3245,
            'first_name' => 'Sally',
            'last_name' => 'Smith',
        ],
        [
            'id' => 5342,
            'first_name' => 'Jane',
            'last_name' => 'Jones',
        ],
        [
            'id' => 5623,
            'first_name' => 'Peter',
            'last_name' => 'Doe',
        ]
    ];

    private function getTestArray4()
    {
        return [
            'testArray4' => [
                (new Grow()),
                (new Grow()),
                (new Grow())
            ]
        ];
    }

    private function getTestArray($key):array
    {
        if ($key === 'testArray4') {
            return $this->getTestArray4();
        }

        return $this->$key;
    }

    /**
     * @Route("/grow/arrays", name="Grow_rrays")
     */
    public function testArrays(): Response
    {
        echo "<h3 style='display: block;'>Test array</h3>";
        var_dump($this->testArray);
        echo "<h3 style='display: block;'>Test array2</h3>";
        var_dump($this->testArray2);
        echo "<h3 style='display: block;'>Test array3</h3>";
        var_dump($this->testArray3);
        echo "<h3 style='display: block;'>Test array4</h3>";
        var_dump($this->getTestArray4());
        echo "<br/><br/><br/><br/><h3 style='display:block;'>Exercises</h3>";
        $i = 1;
        foreach ($this->userFunctions as $testArray => $userFunctions) {
            foreach ($userFunctions as $userFunction => $userFunctionDescr) {
                echo "<b>#$i. start $userFunction:<br/></b>";
                echo $userFunctionDescr;
                var_dump(call_user_func([$this,$userFunction],$this->getTestArray($testArray)));
                echo "<br/> <b>end $userFunction;</b><br/><br/>";
                $i++;
            }
        }

        return new Response('');

    }

    private function arrayValues($array):array
    {
        return array_values($array);
    }

    private function arrayFlip($array): array
    {
        return array_flip($array);
    }

    private function arrayChunk($array):array
    {
        return array_chunk($array,2,true);
    }

    private function arrayChangeKeyCase($array):array
    {
        return array_change_key_case(array_flip($array),CASE_UPPER);
    }

    private function arrayColumn($array): array
    {
        return array_column($array,'first_name','id');
    }

    private function arrayCombine($array): array
    {
        $a = array('green', 'red', 'yellow', 'yellow2', 'yellow3');
        return array_combine($a,$array);
    }

    private function arrayCountValues($array){
        return array_count_values($array);
    }

    private function arrayDiff($array){
        return array_diff($array,$this->testArray2_1);
    }

    private function arrayDiffKey($array){
        return array_diff_key($array,$this->testArray2_1);
    }

    private function arrayDiffUKey($array){
        return array_diff_ukey($array, $this->testArray2_1, [$this,'key_compare_func']);
    }

    private function arrayDiffAssoc($array){
        return array_diff_assoc($array,$this->testArray2_1);
    }

    private function key_compare_func($key1, $key2)
    {
        if ($key1 == $key2)
            return 0;
        else if ($key1 > $key2)
            return 1;
        else
            return -1;
    }

    private function test_callback($value){
        return $value."+callback";
    }

    private function arrayFill($array){
        return array_fill(5,6,'dick pic');
    }

    private function arrayFillKeys($array){
        return array_fill_keys($array,'lol');
    }

    private function arrayFilter($array){
        return array_filter($array,function($var){
            return (stristr($var,'test1') !== false);
        });
    }

    private function arrayKeys($array){
        return array_keys($array);
    }

    private function arrayMap($array){
        return array_map([$this,'test_callback'],$array);
    }

    private function arrayMerge($array){
        return array_merge($array,$this->testArray2_1);
    }
    private function arrayMergeRecursive($array){
        return array_merge_recursive($array,$this->testArray);
    }
    private function arrayPad($array){
        return array_pad($array,-10,'pidor');
    }

    private function arrayProduct($array){
        return array_product($array);
    }

    private function arrayPop($array){
        return array_pop($array);
    }

    private function arrayPush($array){
        array_push($array,'ti pidor','ti pidor 2', 'ti pidor 3');
        return $array;
    }

    private function arrayRand($array){
        return array_rand($array,3);
    }

    private function sum($carry, $item)
    {
        $carry += $item;
        return $carry;
    }

    private function arrayReduce($array){
        return array_reduce($array,[$this,"sum"]);
    }
    private function arrayReplace($array){
        return array_replace($array,[0=>'lol',3=>'qwerty1234']);
    }

    private function arrayReverse($array){
        return array_reverse($array,true);
    }

    private function arraySearch($array){
        return array_search("1",$array);
    }

    private function arrayShift($array){
        return array_shift($array);
    }
    private function arraySum($array){
        return array_sum($array);
    }
    private function arrayUIntersect($array){
        return array_uintersect($array,$this->testArray2_1,'strcasecmp');
    }
    private function arrayUIntersectAssoc($array){
        return array_uintersect_assoc($array,$this->testArray2_1,'strcasecmp');
    }
    private function arrayUnique($array){
        return array_unique($array);
    }
    private function arrayUnshift($array){
        return array_unshift($array,'test22');
    }

}

