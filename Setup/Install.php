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

namespace OstClient\Setup;

use Doctrine\ORM\Tools\SchemaTool;
use OstClient\Models;
use Shopware\Bundle\AttributeBundle\Service\CrudService;
use Shopware\Components\Model\ModelManager;
use Shopware\Components\Plugin;
use Shopware\Components\Plugin\Context\InstallContext;

class Install
{
    /**
     * Main bootstrap object.
     *
     * @var Plugin
     */
    protected $plugin;

    /**
     * ...
     *
     * @var InstallContext
     */
    protected $context;

    /**
     * ...
     *
     * @var ModelManager
     */
    protected $modelManager;

    /**
     * ...
     *
     * @var CrudService
     */
    protected $crudService;

    /**
     * ...
     *
     * @var array
     */
    protected $models = [
        Models\Location::class
    ];

    /**
     * ...
     *
     * @param Plugin         $plugin
     * @param InstallContext $context
     * @param ModelManager   $modelManager
     * @param CrudService    $crudService
     */
    public function __construct(Plugin $plugin, InstallContext $context, ModelManager $modelManager, CrudService $crudService)
    {
        // set params
        $this->plugin = $plugin;
        $this->context = $context;
        $this->modelManager = $modelManager;
        $this->crudService = $crudService;
    }

    /**
     * ...
     *
     * @throws \Exception
     */
    public function install()
    {
        // ...
        $this->installModels();
        $this->installRecords();
    }

    /**
     * ...
     *
     * @throws \Doctrine\ORM\Tools\ToolsException
     */
    private function installModels()
    {
        // get entity manager
        $em = $this->modelManager;

        // get our schema tool
        $tool = new SchemaTool($em);

        // ...
        $classes = array_map(
            function ($model) use ($em) {
                return $em->getClassMetadata($model);
            },
            $this->models
        );

        // remove them
        $tool->createSchema($classes);
    }

    /**
     * ...
     *
     * @throws \Zend_Db_Adapter_Exception
     */
    private function installRecords()
    {
        $query = "
            INSERT INTO ost_client_locations (`id`, `ipRange`, `city`) VALUES
            (NULL, '10.1.0.0/16', 'Witten'),
            (NULL, '10.2.0.0/16', 'Witten'),
            (NULL, '10.3.0.0/16', 'Haan'),
            (NULL, '10.5.0.0/16', 'Recklinghausen'),
            (NULL, '10.6.0.0/16', 'Bottrop'),
            (NULL, '10.17.0.0/16', 'Leverkusen');
        ";
        Shopware()->Db()->query($query);
    }
}
