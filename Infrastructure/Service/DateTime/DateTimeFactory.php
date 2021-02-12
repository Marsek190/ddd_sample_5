<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\DateTime;

use DateTime;
use Exception;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Service\Contract\DateTimeFactoryInterface;

class DateTimeFactory implements DateTimeFactoryInterface
{
    /** @inheritDoc */
    public function getFromString($value)
    {
        try {
            return new DateTime($value);
        } catch (Exception $e) {
            return null;
        }
    }

    /** @inheritDoc */
    public function getCurrentDateTime()
    {
        return new DateTime();
    }

    /** @inheritDoc */
    public function getLastDayDateTime()
    {
        return new DateTime('-24 hours');
    }

    /** @inheritDoc */
    public function getYmdHisFormat()
    {
        return 'Y-m-d H:i:s';
    }
}
