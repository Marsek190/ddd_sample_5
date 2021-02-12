<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Storage\Factory;

use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Storage\TemporaryFileHandler;

class FileHandlerFactory implements FileHandlerFactoryInterface
{
    /**
     * @inheritDoc
     */
    public function getTemporaryFileHandler()
    {
        return new TemporaryFileHandler();
    }
}
