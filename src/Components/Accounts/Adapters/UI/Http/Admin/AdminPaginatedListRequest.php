<?php declare(strict_types=1);

namespace Components\Accounts\Adapters\UI\Http\Admin;

use Illuminate\Foundation\Http\FormRequest;

final class AdminPaginatedListRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [];
    }

    public function start(int $default = 0): int
    {
        /* @phpstan-ignore-next-line */
        return max((int) $this->query('page', $default) - 1, 0);
    }

    public function length(int $default = 10): int
    {
        /* @phpstan-ignore-next-line */
        return max(10, (integer) $this->query('length', $default));
    }

    public function filter(): array
    {
        return array_filter((array) $this->input('filter', []));
    }
}
