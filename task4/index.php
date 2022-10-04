<?php

include 'src/TariffInterface.php';
include 'src/TariffAbstract.php';
include 'src/TariffBasic.php';
include 'src/TariffStudent.php';
include 'src/TariffHour.php';
include 'src/ServiceInterface.php';
include 'src/ServiceGPS.php';
include 'src/ServiceDriver.php';

/** @var TariffInterface $tariff */
$tariff = new TariffBasic(5, 60);
//$tariff = new TariffStudent(2, 15);
//$tariff = new TariffHour(2, 15);
$tariff->addService(new ServiceGPS(15));
$tariff->addService(new ServiceDriver(100));
echo $tariff->countPrice();
