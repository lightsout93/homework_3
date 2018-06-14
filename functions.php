<?php

function task1($file)
{
    $xml = file_get_contents($file);
    $xml = new SimpleXMLElement($xml);

    foreach ($xml->attributes() as $key => $value) {
        echo "$key : $value <br>";
    }
    foreach ($xml as $key => $value) {
        echo "$key {$value->attributes()->__toString()}<br>";
        foreach ($value as $key2 => $value2) {
            echo "$key2 {$value2->attributes()->__toString()} $value2 <br>";
            foreach ($value2 as $key3 => $value3) {
                echo "$key3: $value3 <br>";
            }
        }
        echo $value . '<br><br>';
    }
}

function task2($array)
{
    $encodeArray = json_encode($array);
    file_put_contents('output.json', $encodeArray);
    $file = json_decode(file_get_contents('output.json'));
    if (rand(0, 1)) {
        shuffle($file);
    }
    file_put_contents('output2.json', json_encode($file));
    $encodeArrayResult = file_get_contents('output2.json');
    $arrayShuffle = json_decode($encodeArrayResult);
    $arrayResult = [];
    foreach ($array as $key => $value) {
        $arrayResult[] = array_diff($value, $arrayShuffle[$key]);
    }
    print_r($arrayResult);
}

function task3()
{
    $file = fopen('task3.csv', 'w');
    fputcsv($file, range(1, 100));
    fclose($file);
    $file1 = fopen('task3.csv', 'r');
    $array = fgetcsv($file1, 1000, ',');
    $i = 0;
    foreach ($array as $value) {
        if ($value % 2 === 0) {
            $i += $value;
        }
    }
    echo '<br>Сумма всех четных чисел: ' . $i . '<br>';
}

function task4()
{
    $url = 'https://en.wikipedia.org/w/api.php?action=query&titles=Main%20Page&prop=revisions&rvprop=content&format=json';
    $file = file_get_contents($url);
    $json = json_decode($file);
    echo '<br>Title: ' . $json->{"query"}->{"pages"}->{"15580374"}->{"title"} . '<br>';
    echo 'Page id: ' . $json->{"query"}->{"pages"}->{"15580374"}->{"pageid"};
}
