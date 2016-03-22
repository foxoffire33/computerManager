<?php

namespace frontend\components\api;

use yii\helpers\Json;

class PostcodeApi
{

    const RELEAZ_LAT = 53.246382;
    const RELEAZ_LON = 6.572941;
    public $return = false;
    private $apiUrl = 'http://api.postcodedata.nl/v1/postcode/?postcode={postcode}&streetnumber={huisnummer}&ref={uid}&type=json';

    public function __construct($zipcode, $houseNumber)
    {
        if (isset($zipcode) && isset($houseNumber)) {
            $replacedPostcodeUrl = str_replace('{postcode}', $zipcode, $this->apiUrl);
            $replacedPostcodeUrl = str_replace('{huisnummer}', $houseNumber, $replacedPostcodeUrl);
            $apiCallData = $this->CurlAction($replacedPostcodeUrl);
            if (isset($apiCallData['status']) && $apiCallData['status'] == 'ok' && isset($apiCallData['details'][0])) {
                $this->return = $apiCallData['details'][0];
            }
        }
    }

    private function CurlAction($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = Json::decode(curl_exec($ch));
        curl_close($ch);
        return $output;
    }

    public function getDistanceToReleaz()
    {
        return round(rad2deg(acos(cos(deg2rad($this->return['lat'])) * cos(deg2rad(self::RELEAZ_LAT)) * cos(((deg2rad($this->return['lon'])) - (deg2rad(self::RELEAZ_LON)))) + sin(deg2rad($this->return['lat'])) * sin(deg2rad(self::RELEAZ_LAT)))) * 111.045);
    }

}