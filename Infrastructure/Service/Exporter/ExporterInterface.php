<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Exporter;

use Exception;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Storage\FileHandlerInterface;

interface ExporterInterface
{
    /**
     * @param array $splitedIssues
     * @return FileHandlerInterface
     * @throws Exception
     */
    public function export(array $splitedIssues);
}
