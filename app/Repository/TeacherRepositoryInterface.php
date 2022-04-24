<?php

namespace App\Repository;


interface TeacherRepositoryInterface{


    public function getAllTeachers();

    public function getGender();

    public function getSpecializations();

    public function StoreTeachers($request);

    public function editTeachers($id);

    // UpdateTeachers
    public function UpdateTeachers($request);

    public function DeleteTeachers($request);
}


