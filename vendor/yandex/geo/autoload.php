<?php

function __dm_autoload_geo( $name )
{
	$map = array (
  'Yandex\\Geo\\Api' => 'source/Yandex/Geo/Api.php',
  'Yandex\\Geo\\Exception' => 'source/Yandex/Geo/Exception.php',
  'Yandex\\Geo\\Exception\\CurlError' => 'source/Yandex/Geo/Exception/CurlError.php',
  'Yandex\\Geo\\Exception\\ServerError' => 'source/Yandex/Geo/Exception/ServerError.php',
  'Yandex\\Geo\\GeoObject' => 'source/Yandex/Geo/GeoObject.php',
  'Yandex\\Geo\\Response' => 'source/Yandex/Geo/Response.php',
);
	if ( isset( $map[ $name ] ) )
	{
		require $map[ $name ];
	}
}
spl_autoload_register( '__dm_autoload_geo' );
