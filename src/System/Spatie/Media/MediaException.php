<?php

namespace System\Spatie\Media;

final class MediaException extends \RuntimeException
{
    /**
     * @param \Throwable $exception
     *
     * @throws MediaException
     */
    public static function throwFromException(\Throwable $exception): void
    {
        throw new self((string) $exception->getMessage(), (int) $exception->getCode(), $exception);
    }
}
