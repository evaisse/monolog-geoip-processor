<?php
/**
 * Monolog processor to append Maxmind GEOIP values to logs
 *
 * @author evaisse@gmail.com
 */


namespace evaisse\MonologGeoIpProcessor;


/**
 * Class GeoIpProcessor
 */
class GeoIpProcessor
{

    /**
     * @var array $_SERVER data of user specified
     */
    protected $serverData;

    /**
     * @param array|\ArrayAccess|null $serverData
     */
    function __construct($serverData = null)
    {
        if (null === $serverData) {
            $this->serverData = &$_SERVER;
        } elseif (is_array($serverData) || $serverData instanceof \ArrayAccess) {
            $this->serverData = $serverData;
        } else {
            throw new \UnexpectedValueException('$serverData must be an array or object implementing ArrayAccess.');
        }
    }


    /**
     * @param  array $record
     * @return array transformed record
     */
    public function __invoke(array $record)
    {
        if (!$this->get('REQUEST_URI')) {
            return $record;
        }

        $record['extra']['geo_city'] = $this->get('GEOIP_CITY');
        $record['extra']['geo_country'] = $this->get('GEOIP_COUNTRY_CODE');
        $record['extra']['geo_point'] = array(floatval($this->get('GEOIP_LONGITUDE')), floatval($this->get('GEOIP_LATITUDE')));
    }

    /**
     * @param $key
     * @return mixed|null
     */
    protected function get($key)
    {
        return array_key_exists($key, $this->serverData) ? $this->serverData[$key] : null;
    }
}