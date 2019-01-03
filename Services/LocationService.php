<?php declare(strict_types=1);

/**
 * Einrichtungshaus Ostermann GmbH & Co. KG - Client
 *
 * @package   OstClient
 *
 * @author    Eike Brandt-Warneke <e.brandt-warneke@ostermann.de>
 * @copyright 2018 Einrichtungshaus Ostermann GmbH & Co. KG
 * @license   proprietary
 */

namespace OstClient\Services;

use Enlight_Controller_Front as Front;
use OstClient\Models\Location;
use OstErpApi\Api\Api;
use OstErpApi\Struct\Store;

class LocationService implements LocationServiceInterface
{
    /**
     * ...
     *
     * @var array
     */
    private $configuration;

    /**
     * ...
     *
     * @param array $configuration
     */
    public function __construct(array $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * ...
     *
     * @return string
     */
    public function getCity(): string
    {
        if ($this->configuration['live'] === false) {
            return $this->configuration['city'];
        }

        $ip = $this->getIp();

        /* @var $locations Location[] */
        $locations = Shopware()->Models()->getRepository(Location::class)->findAll();

        foreach ($locations as $location) {
            if ($this->isIpInRange($location->getIpRange(), $ip)) {
                return $location->getCity();
            }
        }

        return '';
    }

    /**
     * ...
     *
     * @return string
     */
    public function getHomeUrl(): string
    {
        if ($this->configuration['live'] === false) {
            return $this->configuration['homeUrl'];
        }

        $foundationConfiguration = Shopware()->Container()->get('ost_foundation.configuration');

        $url = 'http://intranet-apswit11/verkaufsassistent/gethome/';

        $url .= ($foundationConfiguration['company'] === 1) ? 'ostermann' : 'trends';

        $data = file_get_contents($url);

        $arr = json_decode($data, true);

        return $arr['url'];
    }

    /**
     * ...
     *
     * @return string
     */
    public function getRedirectHomeUrl(): string
    {
        if ($this->configuration['live'] === false) {
            return $this->configuration['homeUrl'];
        }

        $foundationConfiguration = Shopware()->Container()->get('ost_foundation.configuration');

        $url = 'http://intranet-apswit11/verkaufsassistent/forceredirect/';

        $url .= ($foundationConfiguration['company'] === 1) ? 'ostermann' : 'trends';

        return $url;
    }

    /**
     * ...
     *
     * @return string
     */
    public function getStoreKey(): string
    {
        $foundationConfiguration = Shopware()->Container()->get('ost_foundation.configuration');

        $company = (int) $foundationConfiguration['company'];
        $city = $this->getCity();

        /* @var $api Api */
        $api = Shopware()->Container()->get('ost_erp_api.api');

        /* @var $stores Store[] */
        $stores = $api->findAll('store');

        foreach ($stores as $store) {
            if ($store->getCompany()->getKey() === $company && $store->getCity() === $city && $store->getType() !== Store::TYPE_ONLINE) {
                return $store->getKey();
            }
        }

        return '';
    }

    /**
     * ...
     *
     * @return string
     */
    private function getIp(): string
    {
        /* @var $front Front */
        $front = Shopware()->Container()->get('front');

        return $front->Request()->getClientIp();
    }

    /**
     * ...
     *
     * @param string $ipRange
     * @param string $ip
     *
     * @return boolean
     */
    private function isIpInRange(string $ipRange, string $ip): bool
    {
        list($startIP, $CIDR) = explode('/', $ipRange);
        $long = ip2long($ip);
        $startIP = ip2long($startIP);

        $ipAmount = 1 << (32 - $CIDR);

        return $long >= $startIP || $long <= $startIP + $ipAmount;
    }
}
