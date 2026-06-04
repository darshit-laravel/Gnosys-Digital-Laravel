<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomField extends Model
{
    protected $guarded = [];

    public function fieldType() {
        return $this->belongsTo(CustomFieldType::class, 'custom_field_type_id', 'id');
    }
}
