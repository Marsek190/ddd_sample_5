<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Domain\Model;

class Notification
{
    /** @var string */
    private $theme;

    /** @var string|null */
    private $description;

    /** @var string|null */
    private $attachment;

    /** @var string[] */
    private $addresses;

    /**
     * @param string $theme
     * @param string|null $description
     * @param string[] $addresses
     * @param string|null $attachment
     */
    public function __construct($theme, $description, $addresses, $attachment)
    {
        $this->theme = $theme;
        $this->description = $description;
        $this->attachment = $attachment;
        $this->addresses = $addresses;
    }

    /** @return string */
    public function getTheme()
    {
        return $this->theme;
    }

    /** @return string|null */
    public function getDescription()
    {
        return $this->description;
    }

    /** @return string|null */
    public function getAttachment()
    {
        return $this->attachment;
    }

    /** @return string[] */
    public function getAddresses()
    {
        return $this->addresses;
    }
}
