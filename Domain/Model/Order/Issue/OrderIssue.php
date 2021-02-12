<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Issue;

use DateTime;
use Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model\Order\Issue\Type\AbstractType;

class OrderIssue
{
    /** @var int */
    public $id;

    /** @var int|null */
    public $publicOrderId = null;

    /** @var string */
    public $externalOrderId;

    /** @var string */
    public $issue;

    /** @var AbstractType */
    public $issueType;

    /** @var DateTime */
    public $dateTimeCreated;

    /** @var DateTime */
    public $dateTimeResolvedPlanned;

    /** @var bool */
    public $isResolved = false;

    /** @var DateTime|null */
    public $dateTimeResolved = null;

    /** @var int */
    public $allottedTimeForResolveInHours;
}
