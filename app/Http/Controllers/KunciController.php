<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KunciController extends Controller
{
    //
    function titikKurva($p, $a, $b)
{
    $qr = [];
    $kurva = [];
    $tmp = [];
    for ($row = 0; $row < $p; $row++) {
        $qr[$row] = ($row * $row) % $p;
        $kurva[$row] = (($row * $row * $row) + ($a * $row) + $b) % $p;
    }

    for ($x = 0; $x < $p; $x++) {
        for ($y = 0; $y < $p; $y++) {
            if ($kurva[$x] == $qr[$y]) {
                $tmp[] = ['x' => $x, 'y' => $y];
            }
        }
    }

    return $tmp;
}

/**
 * @param $p
 * @param $x
 * @param $y
 * @param $a
 * @return array
 */
function representasiTitikKurva($p, $x, $y, $a)
{
    $array_P = $array_TitikKurva = [];
    $atas = (3 * ($x * $x) + $a) % $p;
    $bawah = (2 * $y) % $p;
    $belakang = 2 * $x % $p;

    $array_P['1P'] = ['P' => '1P', 'x' => $x, 'y' => $y, 'symbol' => 'A'];
    $array_TitikKurva["$x,$y"] = 'B';

    $x2 = 0;
    $y2 = 0;
    $counter = 2;

    for ($z = 0; $z < $p; $z++) {
        $bool = (($bawah * $z) % $p == 1) ? "1" : "0";
//        echo "x = $x , y = $y | ($bawah * $z) % $p = " . (($bawah * $z) % $p) . " = {$bool}<br>";
        if (($bawah * $z) % $p == 1) {
            $depan = ($atas * $z) % $p;
            $dk = ($depan * $depan) % $p;
            $x2 = ($dk - $belakang) % $p;

            if ($x2 < 0) {
                $mq = $p * (-1);
                $h = $x2 - $mq;
//                echo "X2 => " . $h . "\t";
            } else {
//                echo "X2 => " . $x2 . "\t";
            }

            $y2 = (($depan * ($x - $x2)) - $y) % $p;

            if ($y2 < 0) {
                $mq = $p * (-1);
                $h = $y2 - $mq;
                $y2 = $h;
//                echo "Y2 => " . $h . "<br>";
            } else {
//                echo "Y2 => " . $y2 . "<br>";
            }

            $array_P['2P'] = ['P' => '2P', 'x' => $x2, 'y' => $y2, 'symbol' => 'B'];
            $array_TitikKurva["$x2,$y2"] = 'B';
            $indexP = 3;
            $hurufP = 'C';

            $counter++;
            for ($kedua = 0; $kedua < $p; $kedua++) {
                $top = ($y2 - $y) % $p;
//                echo "top = ($y2 - $y) % $p = $top<br>";
                $bottom = (($p + (($x2 - $x) % $p)) % $p);
//                echo "bottom = ($x2 - $x) % $p = $bottom<br>";

                for ($k = 0; $k < $p; $k++) {
                    $bool = (($bottom * $k) % $p == 1) ? "1" : "0";
//                    echo "x2 = $x2 , y2 = $y2 | ($bottom * $k) % $p = " . (($bottom * $k) % $p) . " = {$bool}<br>";

                    if ((($bottom * $k) % $p) == 1) {
                        $front = ($top * $k) % $p;
                        $fk = ($front * $front) % $p;
                        $x3 = ($fk - $x - $x2) % $p;

                        if ($x3 < 0) {
                            $temp = $p * (-1);
                            $r = $x3 - $temp;
                            $x2 = $r;
//                            echo "X3 => " . $r . "\t";
                        } else {
                            $x2 = $x3;
//                            echo "x3 => " . $x3 . "\t";
                        }

                        $awal = ($x - $x3) % $p;
                        $kali = ($front * $awal) % $p;
                        $y3 = ($kali - $y) % $p;

                        if ($y3 < 0) {
                            $temp = $p * (-1);
                            $r = $y3 - $temp;
                            $y2 = $r;
//                            echo "Y3 => " . $r . "<br>";
                        } else {
                            $y2 = $y3;
//                            echo "Y3 => " . $y3 . "<br>";
                        }

                        if ($hurufP == 'AA') {
                            $hurufP = 0;
                        } elseif (is_int($hurufP) && $hurufP > 9) {
                            $hurufP = " ";
                        }

                        $array_P[$indexP . 'P'] = ['P' => $indexP . 'P', 'x' => $x2, 'y' => $y2, 'symbol' => $hurufP];
                        $array_TitikKurva["$x2,$y2"] = $hurufP;

                        $hurufP++;
                        $indexP++;
                        $counter++;
                        break;
                    }
                }
            }
        }

    }

    return ['data' => $array_P, 'point' => $array_TitikKurva];
}

/**
 * @param $p
 * @param $x2
 * @param $y2
 * @param $x
 * @param $y
 * @return array
 */
function chipertext2($p, $x2, $y2, $x, $y)
{
    $top = ($y2 - $y) % $p;
//    echo "top = ($y2 - $y) % $p = $top<br>";
    $bottom = (($p + (($x2 - $x) % $p)) % $p);
//    echo "bottom = ($x2 - $x) % $p = $bottom<br>";

    for ($k = 0; $k < $p; $k++) {
//        $bool = (($bottom * $k) % $p == 1) ? "1" : "0";
//        echo "x2 = $x2 , y2 = $y2 | ($bottom * $k) % $p = " . (($bottom * $k) % $p) . " = {$bool}<br>";
        if ((($bottom * $k) % $p) == 1) {
            $front = ($top * $k) % $p;
            $fk = ($front * $front) % $p;
            $x3 = ($fk - $x - $x2) % $p;

            if ($x3 < 0) {
                $temp = $p * (-1);
                $r = $x3 - $temp;
//                echo "X3 => " . $r . "\t";
                $x3 = $r;
            } else {
//                echo "x3 => " . $x3 . "\t";
            }

            $awal = ($x - $x3) % $p;
            $kali = ($front * $awal) % $p;
            $y3 = ($kali - $y) % $p;

            if ($y3 < 0) {
                $temp = $p * (-1);
                $r = $y3 - $temp;
//                echo "Y3 => " . $r . "<br>";
                $y3 = $r;
            } else {
//                echo "Y3 => " . $y3 . "<br>";
            }

            return ['x' => $x3, 'y' => $y3];
        }
    }

    // bila tidak ditemukan
    return ['x' => 0, 'y' => 0];
}

/**
 * @param $id_parameter
 * @param $symbol
 * @param $kQ
 * @param $p
 * @return array
 */
function encrypt($data, $symbol, $kQ, $p)
{
    $M = null;
    foreach ($data as $key => $val) {
        if ("{$val->symbol}" === $symbol) {
            $M = $data->{$key};
            break;
        }
    }

    $C2 = chipertext2($p, $kQ['x'], $kQ['y'], $M->x, $M->y);
    $nbsp = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";

    $C2_print = "C<sub>2</sub> = M + kQ<br>";

    $C2_print .= "{$nbsp}= ({$M->x}, {$M->y}) + ({$kQ['x']},{$kQ['y']})<br>";

    $selectByXY = null;
    foreach ($data as $key => $val) {
        if ($val->x == $C2['x'] && $val->y == $C2['y']) {
            $selectByXY = $data->{$key};
            break;
        }
    }

    $C2_print .= "{$nbsp}= ({$C2['x']},{$C2['y']})<br>";

    $C2 = $selectByXY->symbol;
    $C2_print .= "{$nbsp}= {$C2}<br>";

    return ['plaintext' => $symbol, 'point' => ['x' => $M->x, 'y' => $M->y], 'C2' => $C2, 'C2Print' => $C2_print];
}

function decrypt($data, $d, $p, $a, $charToAscii)
{
    $decryptText = [];
    $chipers = $charToAscii;
    $chipertext = [];
    $tmp = [];


    foreach ($chipers as $key => $val) {
        if ($key % 2) {
            $tmp['C2'] = chr($val);
            $chipertext[] = $tmp;
            $tmp = [];
        } else {
            $tmp['C1'] = chr($val);
        }
    }

    foreach ($chipertext as $key => $value) {

        $titikC1 = null;
        foreach ($data as $dataKey => $dataVal) {
            if ("{$dataVal->symbol}" === $value['C1']) {
                $titikC1 = $data->{$dataKey};
                break;
            }
        }

        $arrayC1 = (representasiTitikKurva($p, $titikC1->x, $titikC1->y, $a));

        $arrayC1['data']["{$d}P"]['y'] = $arrayC1['data']["{$d}P"]['y'] * -1;

        $titikC2 = null;
        foreach ($data as $dataKey => $dataVal) {
            if ("{$dataVal->symbol}" === $value['C2']) {
                $titikC2 = $data->{$dataKey};
                break;
            }
        }

        $tmp = chipertext2($p, $arrayC1['data']["{$d}P"]['x'], $arrayC1['data']["{$d}P"]['y'], $titikC2->x, $titikC2->y);

        $symbolDecrypt = null;
        foreach ($data as $dataKey => $dataVal) {
            if ($dataVal->x == $tmp['x'] && $dataVal->y == $tmp['y']) {
                $symbolDecrypt = $data->{$dataKey};
                break;
            }
        }

        $decryptText['log'][] = '<tr><td class="text-center">(' . $titikC2->x . ',' . $titikC2->y . ') + (' . $arrayC1['data']["{$d}P"]['x'] . ','
            . $arrayC1['data']["{$d}P"]['y'] . ') </td><td class="text-center">' . "{$tmp['x']},{$tmp['y']} </td><td class=\"text-center\">{$symbolDecrypt->symbol}</td></tr>";
        $decryptText['word'][] = $symbolDecrypt->symbol;
    }

    return $decryptText;
}
}
