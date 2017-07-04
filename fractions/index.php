<?php
/**
 * 3-е задание на php-программиста
 */
if (($handle = fopen("input.csv", "r")) !== FALSE) {
        $n = 0;
        $array = [];
     while(($data = fgetcsv($handle, 30, ".")) !== FALSE){

         $fract = 10**(strlen($data[1]))/$data[1]; // Определяем количество дробной части в целом

         if(preg_match('/^\+?\d+$/', $fract)) {
             $array[$n][0] = $data[0];
             $array[$n][1] = '1/' . $fract; // Если $fract целое, то дробную часть запишем таким образом
             $n++;
         }else{
             $array[$n][0] = $data[0];
             $array[$n][1] = $data[1]."/". $fract*$data[1]; // Если $fract нецелое, то дробную часть запишем таким образом
             $n++;
         }
    }
    fclose($handle);

        if (($handle = fopen("output.csv", "w")) !== FALSE) {
            foreach ($array as $row) {
                fputcsv($handle, $row, " ");
            }
            fclose($handle);
        }
    }
?>