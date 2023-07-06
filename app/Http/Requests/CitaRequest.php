<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CitaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nombre' => 'required',
            'correo' => 'required',
            'celular' => 'required',
            'edad' => 'required',
            'primera_vez' => 'required',
            'sexo' => 'required',
            'modalidad' => 'required',
            'hora_cita' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'NOMBRE.',
            'correo.required' => 'CORREO.',
            'celular.required' => 'CELULAR.',        
            'edad.required' => 'EDAD.',  
            'primera_vez.required' => 'PRIMERA VEZ.',  
            'sexo.required' => 'SEXO.',  
            'modalidad.required' => 'MODALIDAD.',         
            'hora_cita.required' => 'FECHA Y HORA DE LA CITA.',  

        ];
    }
}
