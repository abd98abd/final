<?php

namespace App\Models;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{

    use HasTranslations;
    public $translatable = ['Name_Class'];


    protected $table = 'classrooms';
    public $timestamps = true;
    protected $fillable=['Name_Class','Grade_id'];



    public function Grades()
    {
        return $this->belongsTo('App\Models\Grade', 'Grade_id');
    }








}
