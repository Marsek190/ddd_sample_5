<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Sender\Factory;

use Swift_Attachment as Attachment;

interface AttachmentFactoryInterface
{
    /**
     * @param string $fileName
     * @param string $data
     * @param string $contentType
     * @return Attachment
     */
    public function getAttachmentFromData($fileName, $data, $contentType);
}
