<?php
//imagechar($img, 5, 500, 500, $string, $white);
/**
 * Создаем циферблат
 */
$img = imagecreatefrompng("img/clock.png");
imagealphablending($img, false);
imagesavealpha($img, true);

/**
 * Создаем вариацию цветов
 */
$colour = [
    imagecolorallocate($img, 165, 42, 42),
    imagecolorallocate($img, 0, 125, 0),
    imagecolorallocate($img, 0, 0, 125)
    ];

$font = "fonts/TimesNewRomanRegular.ttf"; // шрифт

/**
 * создаем стрелки
 */

$hour = date('H');
$minute = date('i');
$second = date('s');

$name = "hour";
$row = 1; // начало для часов


for ($i = 1; $i <= 3; $i++)
{
    if (($handle = fopen("time.csv", "r")) !== FALSE) {
        do {
            $data = fgetcsv($handle, 1000, ";");
            //
            // Корректно считаем часы
            //
            if (($$name == 0) &&  ($name == "hour")){
                $$name = 12;
            }elseif (($name == "hour") &&  ($$name < 24)){
                $$name = $$name + 61;
            }

            if ($row == $$name) {
                $takenColour = $colour[rand(0, 2)]; // выбираем цвет
                $data = $data[rand(0, 2)]; // выбираем язык

                //
                // Переводим часы, минуты и секунды в градусы
                //
                if($name == "hour") {
                    if(($$name - 61) > 12){
                        $$name = $$name - 12 - 61;
                    }elseif(($$name - 61) == 12 || 0){
                        $$name = 0;
                    }
                    $angl = ($$name * 30) + ($minute/2);
                    if($angl > 360){ $angl = $angl - 360;}
                }else{
                    $angl = $$name * 6;
                }

                //
                // Проэцируем циферблат на тригонометрический круг
                //
                if($angl <= 90){
                    $angl = 90 - $angl;
                }elseif ($angl <= 180){
                    $angl = 360 - ($angl - 90);
                }elseif ($angl <= 270){
                    $angl = 270 - ($angl - 180);
                }elseif ($angl <= 360){
                    $angl = 180 - ($angl - 270);
                }

                //
                // Выводим стрелку
                //
                imagettftext($img, 45, $angl, 338, 331, $takenColour, $font, $data);
            }

            $row++;

        } while ($row <= $$name);

        $row = 0; // начало для минут и секунд
        fclose($handle);

        //
        // Управление исходными данными
        //
        if ($i == 1) {
            $name = "minute";
        } elseif ($i == 2) {
            $name = "second";
        }

    }
}

header("Content-Type:image/png");
imagepng($img, NULL, 0);
?>