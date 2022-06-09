<?php declare(strict_types=1);

namespace Components\Accounts\Adapters\UI\Http\Admin;

use Illuminate\Foundation\Http\FormRequest;

final class AdminPasswordResetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'password' => 'required|confirmed|min:8',
        ];
    }

    public function password(): string
    {
        return $this->validated('password');
    }
}
