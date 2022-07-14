<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth("web")->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'text' => ['required', 'string', 'min:3'],
            'post_id' => ['required'],
            'user_id' => ['required'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'user_id' => auth('web')->id()
        ]);
    }
}
