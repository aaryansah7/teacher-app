<?php

namespace App\Models;

use CodeIgniter\Model;

class TeacherModel extends Model
{
    protected $table         = 'teachers';
    protected $primaryKey    = 'id';
    protected $allowedFields = [
        'user_id',
        'university_name',
        'gender',
        'year_joined',
        'subject',
        'phone',
        'created_at',
        'updated_at'
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'user_id'         => 'required|integer',
        'university_name' => 'required|min_length[3]',
        'gender'          => 'required|in_list[Male,Female,Other]',
        'year_joined'     => 'required|integer|min_length[4]|max_length[4]',
        'subject'         => 'required|min_length[2]',
    ];
}
