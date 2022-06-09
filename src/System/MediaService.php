<?php

namespace System;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use System\Spatie\Media\MediaEnum;
use System\Spatie\Media\MediaException;

interface MediaService
{
    /**
     * @param Model        $model
     * @param UploadedFile $image
     * @param MediaEnum    $collection
     * @param array        $headers
     *
     * @throws MediaException
     */
    public function setMedia(Model $model, UploadedFile $image, MediaEnum $collection, array $headers = []): void;

    /**
     * @param Model     $model
     * @param MediaEnum $collection
     *
     * @throws MediaException
     */
    public function deleteMedia(Model $model, MediaEnum $collection): void;
}
