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

namespace OstClient\Models;

use Doctrine\ORM\Mapping as ORM;
use Shopware\Components\Model\ModelEntity;

/**
 * @ORM\Entity(repositoryClass="Repository")
 * @ORM\Table(name="ost_client_locations")
 */
class Location extends ModelEntity
{
    /**
     * Auto-generated id.
     *
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * ...
     *
     * @var string
     *
     * @ORM\Column(name="ipRange", type="string", nullable=false, length=128)
     */
    private $ipRange;

    /**
     * ...
     *
     * @var string
     *
     * @ORM\Column(name="city", type="string", nullable=false, length=128)
     */
    private $city;

    /**
     * Getter method for the property.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Setter method for the property.
     *
     * @param int $id
     *
     * @return void
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * Getter method for the property.
     *
     * @return string
     */
    public function getIpRange()
    {
        return $this->ipRange;
    }

    /**
     * Setter method for the property.
     *
     * @param string $ipRange
     *
     * @return void
     */
    public function setIpRange(string $ipRange)
    {
        $this->ipRange = $ipRange;
    }

    /**
     * Getter method for the property.
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Setter method for the property.
     *
     * @param string $city
     *
     * @return void
     */
    public function setCity(string $city)
    {
        $this->city = $city;
    }
}
