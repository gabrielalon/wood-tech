<?php declare(strict_types=1);

namespace Components\Accounts\Adapters\UI\Http\Admin\User;

use Components\Accounts\Adapters\Validation\Rules\AdminExists;
use Illuminate\Foundation\Http\FormRequest;

final class UserLoginAttemptRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            $this->username() => [
                'required',
                'string',
                'email',
                AdminExists::prepare(),
            ],
            'password' => 'required|string',
        ];
    }

    /**
     * @return string
     */
    public function username(): string
    {
        return 'email';
    }
}
