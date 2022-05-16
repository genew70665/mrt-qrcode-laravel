<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreEquipmentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'file' => 'required|mimes:csv,txt,xlsx'
            // 'point_id' => 'required',
            // 'site' => 'required',
            // 'area' => 'required',
            // 'unit' => 'required',
            // 'equipment' => 'required',
            // 'description' => 'required',
            // 'fluid_in_use' => 'required',
            // 'fluid_grade' => 'required',
            // 'equipment_type' => 'required',
            // 'most_recent_sample' => 'required',
            // 'last_sample_update' => 'required'
        ];
    }
}
