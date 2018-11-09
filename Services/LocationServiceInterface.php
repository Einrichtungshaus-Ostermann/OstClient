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

interface LocationServiceInterface
{
    /**
     * ...
     *
     * @return string
     */
    public function getCity(): string;



    /**
     * ...
     *
     * @return string
     */
    public function getHomeUrl(): string;



    /**
     * ...
     *
     * @return string
     */
    public function getStoreKey(): string;
}
