<?php

namespace System;

final class JsonSerializer
{
    /** @var string[] */
    private $errors = [
        JSON_ERROR_NONE => 'No error has occurred',
        JSON_ERROR_DEPTH => 'The maximum stack depth has been exceeded',
        JSON_ERROR_STATE_MISMATCH => 'Invalid or malformed JSON',
        JSON_ERROR_CTRL_CHAR => 'Control character error, possibly incorrectly encoded',
        JSON_ERROR_SYNTAX => 'Syntax error',
        JSON_ERROR_UTF8 => 'Malformed UTF-8 characters, possibly incorrectly encoded',
    ];

    public function encode(array $data): string
    {
        if (false === $result = json_encode($data, JSON_UNESCAPED_UNICODE)) {
            throw new \RuntimeException($this->errors[json_last_error()]);
        }

        return $result;
    }

    public function decode(string $json): array
    {
        if (false === $result = json_decode($json, true)) {
            throw new \RuntimeException($this->errors[json_last_error()]);
        }

        if (null === $result) {
            return [];
        }

        return $result;
    }
}
