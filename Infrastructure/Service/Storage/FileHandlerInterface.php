<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Storage;

interface FileHandlerInterface
{
    /**
     * @return string
     */
    public function getFilePath();

    /**
     * @return void
     */
    public function remove();

    /**
     * @param string $content
     * @return void
     */
    public function putContent($content);

    /**
     * @return string|null
     */
    public function getContent();
}
