<?php

namespace Technopark\Marketplace\AliExpress\OrderIssueDiscover\Infrastructure\Service\Storage;

use RuntimeException;

class TemporaryFileHandler implements FileHandlerInterface
{
    /** @var resource */
    private $handler;

    public function __construct()
    {
        $this->handler = tmpfile();
    }

    /**
     * @inheritDoc
     */
    public function getFilePath()
    {
        if (!is_resource($this->handler)) {
            throw new RuntimeException('Файл не существует');
        }

        return stream_get_meta_data($this->handler)['uri'];
    }

    /**
     * @inheritDoc
     */
    public function remove()
    {
        fclose($this->handler);
    }

    /**
     * @inheritDoc
     */
    public function putContent($content)
    {
        file_put_contents($this->getFilePath(), $content, FILE_APPEND);
    }

    /**
     * @inheritDoc
     */
    public function getContent()
    {
        return file_get_contents($this->getFilePath()) ?: null;
    }
}
