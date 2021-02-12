<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\EntityManager;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Phalcon\Config;
use Exception;

class EntityManagerFactory
{
    /** @var array */
    private $technoaprkDbConfig;

    public function __construct(Config $technoparkConfig)
    {
        $this->technoaprkDbConfig = $technoparkConfig->path('database')->toArray();
    }

    /** @return EntityManager|null */
    public function create()
    {
        $entityManagerConfig = Setup::createAnnotationMetadataConfiguration(
            [__DIR__ . '/../Repository'],
            true,
            __DIR__ . '/../../../../../../../var/doctrine/aliexpress',
            null,
            false
        );
        $connection = [
            'dbname'   => $this->technoaprkDbConfig['dbname'],
            'user'     => $this->technoaprkDbConfig['username'],
            'password' => $this->technoaprkDbConfig['password'],
            'host'     => $this->technoaprkDbConfig['host'],
            'port'     => $this->technoaprkDbConfig['port'],
            'driver'   => 'pdo_mysql',
        ];

        try {
            return EntityManager::create($connection, $entityManagerConfig);
        } catch (Exception $e) {
            return null;
        }
    }
}
