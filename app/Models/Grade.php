<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Grade extends Model
{

    use HasTranslations;
    public $translatable = ['Name'];
    protected $fillable=['Name','Note'];
    protected $table = 'Grades';
    public $timestamps = true;





   public function classroom(){



        return $this->belongsTo('App\Models\Classroom',foreignKey:'Grade_id');



    }

    public function Sections()
    {
        return $this->hasMany('App\Models\Section', 'Grade_id');
    }





}
