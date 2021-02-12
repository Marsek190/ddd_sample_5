<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model;

class Product
{
    /** @var string */
    public $article;

    /** @var bool */
    public $archived;

    /** @var int */
    public $stockBalance;

    public function __construct($article, $archived, $stockBalance)
    {
        $this->article = $article;
        $this->archived = $archived;
        $this->stockBalance = $stockBalance;
    }
}
