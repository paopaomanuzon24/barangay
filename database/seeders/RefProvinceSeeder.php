<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class RefProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::unprepared("
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('0128', 'ILOCOS NORTE', '01', '0128', 'ILOCOS NORTE');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('0129', 'ILOCOS SUR', '01', '0129', 'ILOCOS SUR');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('0133', 'LA UNION', '01', '0133', 'LA UNION');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('0155', 'PANGASINAN', '01', '0155', 'PANGASINAN');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('0209', 'BATANES', '02', '0209', 'BATANES');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('0215', 'CAGAYAN', '02', '0215', 'CAGAYAN');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('0231', 'ISABELA', '02', '0231', 'ISABELA');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('0250', 'NUEVA VIZCAYA', '02', '0250', 'NUEVA VIZCAYA');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('0257', 'QUIRINO', '02', '0257', 'QUIRINO');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('0308', 'BATAAN', '03', '0308', 'BATAAN');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('0314', 'BULACAN', '03', '0314', 'BULACAN');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('0349', 'NUEVA ECIJA', '03', '0349', 'NUEVA ECIJA');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('0354', 'PAMPANGA', '03', '0354', 'PAMPANGA');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('0369', 'TARLAC', '03', '0369', 'TARLAC');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('0371', 'ZAMBALES', '03', '0371', 'ZAMBALES');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('0377', 'AURORA', '03', '0377', 'AURORA');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('0410', 'BATANGAS', '04', '0410', 'BATANGAS');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('0421', 'CAVITE', '04', '0421', 'CAVITE');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('0434', 'LAGUNA', '04', '0434', 'LAGUNA');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('0456', 'QUEZON', '04', '0456', 'QUEZON');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('0458', 'RIZAL', '04', '0458', 'RIZAL');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('0505', 'ALBAY', '05', '0505', 'ALBAY');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('0516', 'CAMARINES NORTE', '05', '0516', 'CAMARINES NORTE');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('0517', 'CAMARINES SUR', '05', '0517', 'CAMARINES SUR');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('0520', 'CATANDUANES', '05', '0520', 'CATANDUANES');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('0541', 'MASBATE', '05', '0541', 'MASBATE');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('0562', 'SORSOGON', '05', '0562', 'SORSOGON');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('0604', 'AKLAN', '06', '0604', 'AKLAN');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('0606', 'ANTIQUE', '06', '0606', 'ANTIQUE');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('0619', 'CAPIZ', '06', '0619', 'CAPIZ');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('0630', 'ILOILO', '06', '0630', 'ILOILO');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('0645', 'NEGROS OCCIDENTAL', '06', '0645', 'NEGROS OCCIDENTAL');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('0679', 'GUIMARAS', '06', '0679', 'GUIMARAS');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('0712', 'BOHOL', '07', '0712', 'BOHOL');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('0722', 'CEBU', '07', '0722', 'CEBU');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('0746', 'NEGROS ORIENTAL', '07', '0746', 'NEGROS ORIENTAL');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('0761', 'SIQUIJOR', '07', '0761', 'SIQUIJOR');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('0826', 'EASTERN SAMAR', '08', '0826', 'EASTERN SAMAR');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('0837', 'LEYTE', '08', '0837', 'LEYTE');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('0848', 'NORTHERN SAMAR', '08', '0848', 'NORTHERN SAMAR');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('0860', 'SAMAR (WESTERN SAMAR)', '08', '0860', 'SAMAR (WESTERN SAMAR)');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('0864', 'SOUTHERN LEYTE', '08', '0864', 'SOUTHERN LEYTE');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('0878', 'BILIRAN', '08', '0878', 'BILIRAN');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('0972', 'ZAMBOANGA DEL NORTE', '09', '0972', 'ZAMBOANGA DEL NORTE');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('0973', 'ZAMBOANGA DEL SUR', '09', '0973', 'ZAMBOANGA DEL SUR');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('0983', 'ZAMBOANGA SIBUGAY', '09', '0983', 'ZAMBOANGA SIBUGAY');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('0997', 'CITY OF ISABELA (Not a Province)', '09', '0997', 'CITY OF ISABELA (Not a Province)');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('1013', 'BUKIDNON', '10', '1013', 'BUKIDNON');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('1018', 'CAMIGUIN', '10', '1018', 'CAMIGUIN');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('1035', 'LANAO DEL NORTE', '10', '1035', 'LANAO DEL NORTE');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('1042', 'MISAMIS OCCIDENTAL', '10', '1042', 'MISAMIS OCCIDENTAL');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('1043', 'MISAMIS ORIENTAL', '10', '1043', 'MISAMIS ORIENTAL');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('1123', 'DAVAO DEL NORTE', '11', '1123', 'DAVAO DEL NORTE');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('1124', 'DAVAO DEL SUR', '11', '1124', 'DAVAO DEL SUR');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('1125', 'DAVAO ORIENTAL', '11', '1125', 'DAVAO ORIENTAL');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('1182', 'COMPOSTELA VALLEY', '11', '1182', 'COMPOSTELA VALLEY');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('1186', 'DAVAO OCCIDENTAL', '11', '1186', 'DAVAO OCCIDENTAL');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('1247', 'COTABATO (NORTH COTABATO)', '12', '1247', 'COTABATO (NORTH COTABATO)');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('1263', 'SOUTH COTABATO', '12', '1263', 'SOUTH COTABATO');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('1265', 'SULTAN KUDARAT', '12', '1265', 'SULTAN KUDARAT');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('1280', 'SARANGANI', '12', '1280', 'SARANGANI');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('1298', 'COTABATO CITY (Not a Province)', '12', '1298', 'COTABATO CITY (Not a Province)');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('1339', 'NCR, CITY OF MANILA, FIRST DISTRICT (Not a Province)', '13', '1339', 'NCR, CITY OF MANILA, FIRST DISTRICT (Not a Province)');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('1374', 'NCR, SECOND DISTRICT (Not a Province)', '13', '1374', 'NCR, SECOND DISTRICT (Not a Province)');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('1375', 'NCR, THIRD DISTRICT (Not a Province)', '13', '1375', 'NCR, THIRD DISTRICT (Not a Province)');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('1376', 'NCR, FOURTH DISTRICT (Not a Province)', '13', '1376', 'NCR, FOURTH DISTRICT (Not a Province)');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('1401', 'ABRA', '14', '1401', 'ABRA');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('1411', 'BENGUET', '14', '1411', 'BENGUET');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('1427', 'IFUGAO', '14', '1427', 'IFUGAO');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('1432', 'KALINGA', '14', '1432', 'KALINGA');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('1444', 'MOUNTAIN PROVINCE', '14', '1444', 'MOUNTAIN PROVINCE');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('1481', 'APAYAO', '14', '1481', 'APAYAO');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('1507', 'BASILAN', '15', '1507', 'BASILAN');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('1536', 'LANAO DEL SUR', '15', '1536', 'LANAO DEL SUR');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('1538', 'MAGUINDANAO', '15', '1538', 'MAGUINDANAO');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('1566', 'SULU', '15', '1566', 'SULU');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('1570', 'TAWI-TAWI', '15', '1570', 'TAWI-TAWI');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('1602', 'AGUSAN DEL NORTE', '16', '1602', 'AGUSAN DEL NORTE');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('1603', 'AGUSAN DEL SUR', '16', '1603', 'AGUSAN DEL SUR');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('1667', 'SURIGAO DEL NORTE', '16', '1667', 'SURIGAO DEL NORTE');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('1668', 'SURIGAO DEL SUR', '16', '1668', 'SURIGAO DEL SUR');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('1685', 'DINAGAT ISLANDS', '16', '1685', 'DINAGAT ISLANDS');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('1740', 'MARINDUQUE', '17', '1740', 'MARINDUQUE');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('1751', 'OCCIDENTAL MINDORO', '17', '1751', 'OCCIDENTAL MINDORO');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('1752', 'ORIENTAL MINDORO', '17', '1752', 'ORIENTAL MINDORO');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('1753', 'PALAWAN', '17', '1753', 'PALAWAN');
            INSERT INTO `ref_provinces` (`prov_code`, `prov_name`, `reg_code`, `nscb_prov_code`, `nscb_prov_name`) VALUES('1759', 'ROMBLON', '17', '1759', 'ROMBLON');
        
        ");
    }
}
