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

class ClientService implements ClientServiceInterface
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
     */
    public function isRegistered(): bool
    {
        if ($this->configuration['live'] === false) {
            return (bool) $this->configuration['isRegistered'];
        }

        $url = 'http://intranet-apswit11/verkaufsassistent/isregistered';

        $data = file_get_contents($url);

        $arr = json_decode($data, true);

        return (bool) $arr['isRegistered'];
    }
}
