<?php

if (($handle = fopen("input.txt", "r")) !== FALSE) {
    if ($handle) {
        while (($getN = fgets($handle, 32)) !== false) {
            define("NUMBER", intval(trim($getN)));
        }
        fclose($handle);
    }

    $S = str_repeat("\1", NUMBER); // выбираем строку для экономии памяти

    //
    //Используем решето Эрастофена
    //
    for ($i = 2; $i * $i <= NUMBER; $i++) {
        if ($S[$i] === "\1") {
            for ($j = $i * $i; $j <= NUMBER; $j += $i) {
                $S[$j] = "\0";
            }
        }
    }

    $result = [];

    for($i=2; $i<=NUMBER; $i++){
        if ($S[$i] == "\1") {
            $result[] = $i;
        }
    }

    if (($handle = fopen("output.txt", "w")) !== FALSE) {
        if ($handle)
        {
            fwrite($handle, implode(' ',$result));
            fclose($handle);
        }
    }

}
?>