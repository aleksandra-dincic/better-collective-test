<?php

namespace App\Http\Requests;

use App\Support\RequestInterface;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest implements RequestInterface
{
    /**
     * @return string
     */
    public function name(): string
    {
        return $this->post('name');
    }

    /**
     * @return string
     */
    public function yearOfBirth(): string
    {
        return $this->post('year_of_birth');
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'year_of_birth' => ['required', 'date_format:Y-m-d']
        ];
    }

    /**
     * @return array
     */
    public function getAllFields(): array
    {
        return [
            'name' => $this->name(),
            'year_of_birth' => $this->yearOfBirth(),
        ];
    }
}
