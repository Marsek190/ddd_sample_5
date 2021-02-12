<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Repository\Order\Issue\Dto;

use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * @ORM\Entity()
 * @ORM\Table(name="tp_order_issue_aliexpress")
 */
class OrderIssueDto
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer", nullable=false)
     * @var int
     */
    public $id;

    /**
     * @ORM\Column(name="public_order_id", type="integer", nullable=true)
     * @var int|null
     */
    public $publicOrderId = null;

    /**
     * @ORM\Column(name="external_order_id", type="string", nullable=false, length=50)
     * @var string
     */
    public $externalOrderId;

    /**
     * @ORM\Column(type="string", nullable=false, length=500)
     * @var string
     */
    public $issue;

    /**
     * @ORM\Column(name="issue_type", type="string", nullable=false, length=255)
     * @var string
     */
    public $issueType;

    /**
     * @ORM\Column(name="date_time_created", type="datetime", nullable=false)
     * @var DateTime
     */
    public $dateTimeCreated;

    /**
     * @ORM\Column(name="date_time_resolved_planned", type="datetime", nullable=false)
     * @var DateTime
     */
    public $dateTimeResolvedPlanned;

    /**
     * @ORM\Column(name="is_resolved", type="boolean", nullable=false)
     * @var bool
     */
    public $isResolved = false;

    /**
     * @ORM\Column(name="date_time_resolved", type="datetime", nullable=true)
     * @var DateTime|null
     */
    public $dateTimeResolved = null;

    /**
     * @ORM\Column(name="allotted_time_for_resolve_in_hours", type="integer", nullable=false)
     * @var int
     */
    public $allottedTimeForResolveInHours;
}
