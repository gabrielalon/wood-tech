<?php declare(strict_types=1);

namespace Components\Contents\Adapters\UI\Http\Admin\Offer\Request;

use Illuminate\Foundation\Http\FormRequest;

final class OfferCreateRequest extends FormRequest
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
        return [
            'name.*' => 'required|string|min:1|max:255',
            'lead.*' => 'required|string|min:1|max:65255',
            'description.*' => 'required|string|min:1|max:65255',
        ];
    }
}
