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
     * @return string
     */
    public function __construct( array $configuration )
    {
        $this->configuration = $configuration;
    }



    /**
     * ...
     *
     */
    public function isRegistered(): bool
    {
        if ( $this->configuration['live'] == false )
            return (boolean) $this->configuration['isRegistered'];




        $url = "http://intranet-apswit11/verkaufsassistent/isregistered";

        $data = file_get_contents( $url );

        $arr = json_decode( $data, true );


        return (boolean) $arr['isRegistered'];


    }



}
