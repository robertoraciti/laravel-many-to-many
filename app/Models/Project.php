<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'repo', 'collaborators', 'publishing_date', 'typology_id'];

    public function typology()
    {
        return $this->belongsTo(Typology::class);
    }

    public function getTypologyName()
    {
        return $this->typology ? "<span class='badge' style='background-color: {$this->typology->color}'>{$this->typology->name}</span>" : "";
    }


}