<?php

namespace System\Messaging\Infrastructure\Service;

final class CallbackSerializer
{
    /** callable */
    private string $serializeCallback = 'serialize';

    /** callable */
    private string $unserializeCallback = 'unserialize';

    /**
     * @param mixed $data
     *
     * @return string
     */
    public function serialize($data): string
    {
        return \call_user_func($this->serializeCallback, $data);
    }

    /**
     * @param string $serialized
     *
     * @return mixed
     */
    public function unserialize(string $serialized)
    {
        return \call_user_func($this->unserializeCallback, $serialized);
    }
}
