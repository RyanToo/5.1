<?php
ini_set('display_errors', 'Off');

function getPost($var)
{
    $cleanvar = htmlspecialchars(trim($_POST[$var]));
    return($cleanvar);
}

function getCoordinates($address)
{
    require_once __DIR__ . '/vendor/autoload.php';
//    echo __DIR__ . '/composer/autoload_real.php';
    $api = new \Yandex\Geo\Api();
    $api->setQuery($address);
    $api
	    ->setLimit(6) // кол-во результатов
	    ->setLang(\Yandex\Geo\Api::LANG_RU) // локаль ответа
	    ->load();
    $response = $api->getResponse();
    $collection = $response->getList();
    foreach ($collection as $item)
    {
	$item->getAddress(); // вернет адрес
	$coordinates['Latitude'] = $item->getLatitude(); // широта
	$coordinates['Longitude'] = $item->getLongitude(); // долгота
	$item->getData(); // необработанные данные
    }

    return ($coordinates);
}

if (isset($_POST['address']))
{

    $address = getPost('address');
    $coordinates = getCoordinates($address);
    unset($_POST);
}
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
	<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>

        <title>Composer</title>
    </head>
    <body>
	<h1>Поиск координат по адресу</h1>


	<p>Для поиска введите адрес</p>
	<form action="" method="POST">
	    <input type="text" name="address" >
	    <input type="submit" value="Поиск">
	</form>
	<?php
	if (isset($coordinates))
	{
	    ?>
    	<p>Широта: <?= $coordinates['Latitude'] ?></p>
    	<p>Долгота: <?= $coordinates['Longitude'] ?></p>
    	<p>Для адреса:<?= $address ?></p>
    	<div id="map" style="width: 80%; height: 400px; margin: 40px auto"></div>
	    <?php
	}
	?>
	<script>
            ymaps.ready(function () {
                var myMap = new ymaps.Map('map', {
                    center: [<?= $coordinates['Latitude'] ?>, <?= $coordinates['Longitude'] ?>],
                    zoom: 15
                }, {
                    searchControlProvider: 'yandex#search'
                }),
                        myPlacemark = new ymaps.Placemark(myMap.getCenter(), {
                            hintContent: '<?= $address ?>',
                            balloonContent: 'Это красивая метка'
                        }, {
                            // Опции.
                            // Необходимо указать данный тип макета.
                            iconLayout: 'default#image',
                            // Своё изображение иконки метки.
                            iconImageHref: 'http://netology.ru/favicon.ico',
                            // Размеры метки.
                            iconImageSize: [30, 30],
                            // Смещение левого верхнего угла иконки относительно
                            // её "ножки" (точки привязки).
                            iconImageOffset: [-3, -42]
                        });

                myMap.geoObjects.add(myPlacemark);
            });
	</script>
    </body>
</html>