<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Storage\Factory;

use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Storage\TemporaryFileHandler;

interface FileHandlerFactoryInterface
{
    /**
     * @return TemporaryFileHandler
     */
    public function getTemporaryFileHandler();
}
