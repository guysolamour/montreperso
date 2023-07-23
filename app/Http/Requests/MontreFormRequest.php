<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MontreFormRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            "nom"                    => ['sometimes', 'required', 'string'],
            "bracelet"               => ['sometimes', 'required'],
            "id_forme"               => ['sometimes', 'required', 'exists:App\Models\Forme,id_forme'],
            "id_index"               => ['sometimes', 'required', 'exists:App\Models\Index,id_index'],
            "id_index_image"         => ['sometimes', 'required', 'exists:App\Models\IndexMedia,id_index_media'],
            "id_aiguille"            => ['sometimes', 'required', 'exists:App\Models\Aiguille,id_aiguille'],
            "id_arriere_plan"        => ['sometimes', 'required', 'exists:App\Models\ArrierePlan,id_arriere_plan'],
            "id_arriere_plan_image"  => ['sometimes', 'nullable'],
            "id_user"                => ['sometimes', 'required', 'exists:App\User,id_user'],
            "texte_fond"             => ['sometimes', 'required' ],
            "image_fond"             => ['sometimes','required' ]
        ];
    }
}
