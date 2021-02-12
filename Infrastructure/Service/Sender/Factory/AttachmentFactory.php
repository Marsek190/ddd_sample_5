<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Sender\Factory;

use Swift_Attachment as Attachment;

class AttachmentFactory implements AttachmentFactoryInterface
{
    /** @inheritDoc */
    public function getAttachmentFromData($fileName, $data, $contentType)
    {
        return Attachment::newInstance($data, $fileName, $contentType);
    }
}
