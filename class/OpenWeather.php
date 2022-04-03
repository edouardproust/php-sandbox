<?php

/**
 * Manage the OpenWeather API
 *
 * @author  Edouard Proust <edouardproust@gmail.com>
 *
 * @var string ICON_SIZE (constant) Define the size of the weather icon ('1x', '2x' or '4x')
 * @var string UNITS (constant) Define temparature unit ('default' = kelvin, 'metric' = Celsius, 'imperial' = Fahrenheit)
 * @var string $api_key The API key provided in OpenWeather account > My API keys
 * @var int $timeout cURL timeout delay. Value is defined in weather.php
 */
class OpenWeather
{

    const ICON_SIZE = '2x';
    const UNITS = 'metric';
    private $api_key;
    private $timeout;

    /**
     * Class constructor
     *
     * @param string $apiKey The full API key string
     * @param  mixed $timeOut Timeout allowed for the API to run
     * @return void
     */
    public function __construct(string $apiKey, int $timeOut)
    {
        $this->api_key = $apiKey;
        $this->timeout = $timeOut;
    }

    /**
     * Get the weather data for current moment
     *
     * @param  mixed $coordinates [latitude, longitude]
     * @return array [(int)'temp', (string)'description' , (string)'icon', (DateTime)'time' ]
     */
    public function getCurrent(array $coordinates): ?array
    {
        $result = [];
        $data = $this->callAPI($coordinates);
        if (!empty($data)) {
            $result = $this->getResult($data);
        }
        return $result;
    }

    /**
     * Format the location string to get a proper City name + Country code
     *
     * @param  string $location 'location-name_country-code' (example: 'paris_fr', 'new-york_us')
     * @return array [(string)city name, (string)country code]
     */
    public static function getName(string $location): array
    {
        $parts = explode('_', $location);
        $loc_array['city'] = implode('-', array_map('ucfirst', explode('-', $parts[0])));
        $loc_array['country'] = strtoupper($parts[1]);
        return $loc_array;
    }

    /**
     * Call OpenWeather API
     *
     * @param array $coordinates [latitude, longitude]
     * @return null|array json_decode[]
     * 
     * @throws CurlException cURL error (timeout,...)
     * @throws HTTPException API error returning any HTTP code (401, 404,...)
     */
    private function callAPI(array $coordinates): ?array
    {
        $time = time() - 1;
        $latitude = $coordinates[0];
        $longitude = $coordinates[1];
        $unit = self::UNITS;
        $curl = curl_init("https://api.openweathermap.org/data/2.5/weather?lat={$latitude}&lon={$longitude}&dt=$time&units={$unit}&appid={$this->api_key}");
        curl_setopt_array($curl, [
            CURLOPT_CAINFO          => dirname(__DIR__) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'certificates' . DIRECTORY_SEPARATOR . 'openweather.cer',
            CURLOPT_RETURNTRANSFER  => true,
            CURLOPT_TIMEOUT_MS      => $this->timeout
        ]);
        $data = curl_exec($curl);
        if ($data === false) {
            throw new CurlException($curl);
        }
        $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ($code !== 200) {
            curl_close($curl);
            throw new HTTPException($data);
        }
        curl_close($curl);
        return json_decode($data, true);
    }

    /**
     * Formats weather data and returns it into an array 
     *
     * @param  mixed $data ($data["current"], $data["hourly"],...)
     * @param  mixed $timezone ($data["timezone"],...)
     * @return array [(int)'temp', (string)'description' , (string)'icon', (DateTime)'time' ]
     */
    private function getResult($data): array
    {
        if (self::ICON_SIZE === '2x' || self::ICON_SIZE === '4x') {
            $icon_size = '@' . self::ICON_SIZE;
        } else {
            $icon_size = '';
        }
        return [
            'temp'          => $data["main"]["temp"] . '°C',
            'description'   => ucfirst($data["weather"][0]["description"]),
            'icon'          => 'http://openweathermap.org/img/wn/' . $data["weather"][0]["icon"] . $icon_size . '.png',
            'time'          => $this->getTimeFormated($data["dt"], $data["timezone"]),
        ];
    }

    /**
     * Formats several datetime strings and store them into an array
     *
     * @param  mixed $timestamp (time(),...)
     * @param  mixed $timezone ($data["timezone"], 'Europe/Paris',...)
     * @return array string[]
     */
    private function getTimeFormated($timestamp, $timezone): array
    {
        if (is_int($timezone)) {
            $timezone = timezone_name_from_abbr('', $timezone, 0);
        }
        $date = new DateTime("@" . $timestamp);
        $date->setTimezone(new DateTimeZone($timezone));
        return  [
            'all' => $date->format('M d g:i a'),
            'date' => $date->format('M d'),
            'hour' => $date->format('g a'),
        ];
    }
}
