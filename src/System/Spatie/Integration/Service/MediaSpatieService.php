<?php

namespace System\Spatie\Integration\Service;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Spatie\MediaLibrary\MediaCollections\Exceptions;
use System\Eloquent\Contracts\HasMedia;
use System\MediaService;
use System\Spatie\Media\MediaEnum;
use System\Spatie\Media\MediaException;

final class MediaSpatieService implements MediaService
{
    /**
     * @param string $name
     * @param mixed  $arguments
     *
     * @return string
     */
    public function __call(string $name, mixed $arguments): string
    {
        if ($enum = MediaEnum::tryFrom($name)) {
            return $enum->value;
        }

        return '';
    }

    /**
     * {@inheritdoc}
     */
    public function setMedia(Model $model, UploadedFile $image, MediaEnum $collection, array $headers = []): void
    {
        assert($model instanceof HasMedia);

        if ($model->hasMedia($collection->value)) {
            $this->deleteMedia($model, $collection);
        }

        try {
            $model
                ->addMedia($image)
                ->usingFileName($this->hashFileName($image))
                ->addCustomHeaders($headers)
                ->toMediaCollection($collection->value)
            ;
        } catch (Exceptions\FileCannotBeAdded $exception) {
            MediaException::throwFromException($exception);
        } catch (\Exception $exception) {
            MediaException::throwFromException($exception);
        }
    }

    /**
     * @param UploadedFile $image
     *
     * @return string
     */
    private function hashFileName(UploadedFile $image): string
    {
        return md5($image->hashName().microtime()).'.'.$image->extension();
    }

    /**
     * {@inheritdoc}
     */
    public function deleteMedia(Model $model, MediaEnum $collection): void
    {
        assert($model instanceof HasMedia);

        $media = $model->getMedia($collection->value);

        try {
            $model->deleteMedia($media->first());
        } catch (Exceptions\MediaCannotBeDeleted $exception) {
        }
    }
}
