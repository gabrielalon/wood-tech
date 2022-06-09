<?php declare(strict_types=1);

namespace Components\Accounts\Adapters\UI\Http\Admin;

use Illuminate\Foundation\Http\FormRequest;
use System\Illuminate\Rules\FullName;

final class AdminDataUpdateRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'full_name' => ['required', 'string', new FullName()],
            'locale' => 'string|exists:language,code',
        ];
    }

    public function fullName(): string
    {
        return $this->validated('full_name');
    }

    public function locale(): string
    {
        return $this->validated('locale');
    }
}
