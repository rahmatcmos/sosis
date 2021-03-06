<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateSendRequest extends Request
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
            'DestinationNumber' => 'required_without:group',
            'group'             => 'required_without:DestinationNumber',
            'TextDecoded'       => 'required|max:160',
            'SendingDateTime'   => 'date'
        ];
    }
}
