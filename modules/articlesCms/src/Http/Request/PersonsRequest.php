<?php

namespace Cms\Articles\Request;
/**
 * Description of PersonsRequest
 *
 * @author patryk
 */
class PersonsRequest extends \Illuminate\Foundation\Http\FormRequest {

    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            "phone" => "required|numeric|min:9|max:11",
            "name" => "required",
            "country" => "required",
            "bdate" => "required|date",
            "qualifications" => "required",
            "skills" => "required",
            "langs" => "required",
            "paymants" => "required",
            "sdate" => "required|date",
            "comments" => "max:500"
        ];
    }

    public function messages() {
        return [
            'required'=>"wypełnij wszystkie pola z gwiazdką",
            'date'=>"wypełnij poprawnie date YYYY-MM-DD",
            'phone.min'=>"Nie poprawny nr tel. np: 500500500",
            'phone.max'=>"Nie poprawny nr tel. np: 48500500500",
        ];
    }

}
