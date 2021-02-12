<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Service\Contract;

use Exception;

interface LoggerInterface
{
    /**
     * Логирует исключение
     *
     * @param Exception $exception
     */
    public function logException(Exception $exception);
}
