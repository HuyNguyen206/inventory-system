<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EditEmployeeSalaryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->employee->name,
            'email' => $this->employee->email,
            'salary_month' => $this->salary_month,
            'salary' => $this->amount,
        ];
    }
}
