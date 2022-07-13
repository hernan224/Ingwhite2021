<?php
class Clima_Controller {

    private $src_path;
    private $dest_path;
    private $zip_path;

    private $iconsClima = array(
        1=> '050-sun',  //'wi-day-sunny',
        2=> '050-sun',  //'wi-day-sunny-overcast',
        3=> '027-cloudy-1',  //'wi-day-cloudy',
        4=> '005-cloudy-3',  //'wi-day-cloudy',
        5=> '033-sunrise',  //'wi-day-haze',
        6=> '003-cloudy-4',  //'wi-day-cloudy-high',
        7=> '023-clouds-2',  //'wi-cloud',
        8=> '049-clouds',  //'wi-cloudy',
        11=>'030-clouds-1',  //'wi-fog',
        12=>'010-rain-3',  //'wi-showers',
        13=>'038-rain-1',  //'wi-day-showers',
        14=>'038-rain-1',  //'wi-day-showers',
        15=>'041-storm',  //'wi-thunderstorm',
        16=>'012-rain-2',  //'wi-day-thunderstorm',
        17=>'012-rain-2',  //'wi-day-storm-showers',
        18=>'040-rain',  //'wi-rain',
        19=>'008-snow-1',  //'wi-snow-wind',
        20=>'008-snow-1',  //'wi-day-snow-wind',
        21=>'008-snow-1',  //'wi-day-snow-wind',
        22=>'042-snow',  //'wi-snow',
        23=>'042-snow',  //'wi-day-snow',
        24=>'018-snowflake',  //'wi-hail',
        25=>'040-rain',  //'wi-sleet',
        26=>'042-snow',  //'wi-rain-mix',
        29=>'042-snow',  //'wi-rain-mix',
        30=>'046-temperature-1',  //'wi-hot',
        31=>'048-temperature',  //'wi-snowflake-cold',
        32=>'001-wind-1',  //'wi-strong-wind',
        33=>'034-moon',  //'wi-night-clear',
        34=>'009-cloud',  //'wi-night-alt-partly-cloudy',
        35=>'043-cloudy',  //'wi-night-alt-cloudy',
        36=>'043-cloudy',  //'wi-night-alt-cloudy',
        37=>'032-moon-1',  //'wi-night-fog',
        38=>'020-moon-3',  //'wi-night-alt-cloudy-high',
        39=>'011-night-rain',  //'wi-night-alt-showers',
        40=>'011-night-rain',  //'wi-night-alt-rain',
        41=>'012-rain-2',  //'wi-night-alt-storm-showers',
        42=>'041-storm',  //'wi-night-alt-thunderstorm',
        43=>'008-snow-1',  //'wi-night-alt-snow',
        44=>'042-snow',  //'wi-night-alt-snow-wind'
    );

    public function __construct($urlClima, $zipNombre, $copiaZip, $pathXML, $xmlNombre, $templateDir)
    {
        $this->src_path = $urlClima.$zipNombre;
        $this->dest_path = realpath($templateDir.$pathXML.$copiaZip);
        $this->zip_path = 'zip://'.$this->dest_path.'#'.$xmlNombre;
    }

    public function getClimaObj() {
        // Copy clima file
        if (!@copy($this->src_path, $this->dest_path)) {
            return false;
        }

        libxml_use_internal_errors(true);
        // Extract zip content
        $stringXML = file_get_contents($this->zip_path);
        // Expose clima obj
        return simplexml_load_string($stringXML);
    }

    public function getIcon($climaObj) {
        if (empty($climaObj) || $climaObj === false || empty($climaObj->location->icon)) return false;

        $iconNum = intval($climaObj->location->icon);
        return $this->iconsClima[$iconNum];
    }

    public function getTemp($climaObj) {
        if (empty($climaObj) || $climaObj === false || empty($climaObj->location->temp)) return false;

        return $climaObj->location->temp;
    }

    public function getTempSt($climaObj) {
        if (empty($climaObj) || $climaObj === false || empty($climaObj->location->real_feel)) return false;

        return $climaObj->location->real_feel;
    }

    public function getCondition($climaObj) {
        if (empty($climaObj) || $climaObj === false || empty($climaObj->location->SPL)) return false;

        return $climaObj->location->SPL;
    }

    public function getHumidity($climaObj) {
        if (empty($climaObj) || $climaObj === false || empty($climaObj->location->rhumid)) return false;

        return $climaObj->location->rhumid;
    }

    public function getPression($climaObj) {
        if (empty($climaObj) || $climaObj === false || empty($climaObj->location->pres)) return false;

        return $climaObj->location->pres;
    }

    public function getWind($climaObj) {
        if (empty($climaObj) || $climaObj === false || empty($climaObj->location->wind_dir) || empty($climaObj->location->windspeed)) return false;

        $windObj = [
            "speed" => $climaObj->location->windspeed,
            "unit" => $climaObj->location->windspeed['unit'],
            "direction" => str_replace('W', 'O', $climaObj->location->wind_dir),
            "icon" => 'wi-towards-'.strtolower($climaObj->location->wind_dir)
        ];

        return $windObj;
    }

}