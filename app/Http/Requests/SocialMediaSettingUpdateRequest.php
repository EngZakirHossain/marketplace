<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SocialMediaSettingUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'site_facebook_link' => 'nullable|string|max:255',
            'site_twitter_link' => 'nullable|string|max:255',
            'site_instragram_link' => 'nullable|string|max:255',
            'site_behance_link' => 'nullable|string|max:255',
            'site_dribbble_link' => 'nullable|string|max:255',
        ];
    }
}
