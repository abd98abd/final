<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasTranslations;
    public $translatable = ['Name_Section'];

    protected $fillable=['Name_Section','Grade_id','Class_id'];

    protected $table = 'sections';
    public $timestamps = true;


    // علاقة بين الاقسام والصفوف لجلب اسم الصف في جدول الاقسام



    public function My_classs()
    {
        return $this->belongsTo('App\Models\Classroom', foreignKey: 'Class_id');
    }


}
