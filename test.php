<?php
function get_post($var)
{
    $cleanvar = htmlspecialchars(trim($_POST[$var]));
    return($cleanvar);
}

function get_coordinates($address)
{
    require 'W:\domains\test\composer';
//echo __DIR__ . '/vendor/autoload.php';
	$api = new \Yandex\Geo\Api();

	$api->setLang(\Yandex\Geo\Api::LANG_RU); // локаль ответа
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
	    $coordinates[Latitude]=$item->getLatitude() . PHP_EOL; // широта
	    $coordinates[Longitude]=$item->getLongitude(); // долгота
	    $item->getData(); // необработанные данные
	}
	    return ($coordinates);
}
$address='Тула Ленина 68';
$coordinates=get_coordinates($address);
var_dump($coordinates);
?>
