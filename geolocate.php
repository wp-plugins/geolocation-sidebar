<?php
include("geoipcity.inc");
include("geoipregionvars.php");

// uncomment for Shared Memory support
// geoip_load_shared_mem("/usr/local/share/GeoIP/GeoIPCity.dat");
// $gi = geoip_open("/usr/local/share/GeoIP/GeoIPCity.dat",GEOIP_SHARED_MEMORY);
function getGeoData(){
$gi = geoip_open(dirname(__FILE__)."/GeoLiteCity.dat",GEOIP_STANDARD);
$ip = $_SERVER['REMOTE_ADDR'];
$record = geoip_record_by_addr($gi,$ip);
geoip_close($gi);
return $record;
}

?>