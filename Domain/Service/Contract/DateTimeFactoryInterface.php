<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Service\Contract;

use DateTime;

interface DateTimeFactoryInterface
{
    /**
     * @param string $value
     * @return DateTime|null
     */
    public function getFromString($value);

    /** @return DateTime */
    public function getCurrentDateTime();

    /** @return DateTime */
    public function getLastDayDateTime();

    /** @return string */
    public function getYmdHisFormat();
}
