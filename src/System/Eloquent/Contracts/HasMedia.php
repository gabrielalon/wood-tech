<?php

namespace System\Eloquent\Contracts;

use Spatie\MediaLibrary\HasMedia as MediaLibrary;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

interface HasMedia extends MediaLibrary
{
    public function deleteMedia(int|string|Media $mediaId): void;
}
