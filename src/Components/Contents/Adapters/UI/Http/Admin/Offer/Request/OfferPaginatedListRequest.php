<?php

namespace Components\Contents\Adapters\UI\Http\Admin\Offer\Request;

use Illuminate\Foundation\Http\FormRequest;

final class OfferPaginatedListRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [];
    }

    /**
     * @param int $default
     *
     * @return int
     */
    public function start(int $default = 0): int
    {
        /* @phpstan-ignore-next-line */
        return max((int) $this->query('page', $default) - 1, 0);
    }

    /**
     * @param int $default
     *
     * @return int
     */
    public function length(int $default = 10): int
    {
        /* @phpstan-ignore-next-line */
        return max(10, $this->query('length', $default));
    }

    /**
     * @return array
     */
    public function filter(): array
    {
        return array_filter((array) $this->input('filter', []));
    }
}
