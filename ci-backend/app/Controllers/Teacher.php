<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\TeacherModel;

class Teacher extends BaseController
{
    public function create()
    {
        $rules = [
            'email'           => 'required|valid_email|is_unique[auth_user.email]',
            'first_name'      => 'required|min_length[2]',
            'last_name'       => 'required|min_length[2]',
            'password'        => 'required|min_length[6]',
            'university_name' => 'required|min_length[3]',
            'gender'          => 'required|in_list[Male,Female,Other]',
            'year_joined'     => 'required|integer|min_length[4]|max_length[4]',
            'subject'         => 'required|min_length[2]',
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Validation failed',
                'errors'  => $this->validator->getErrors()
            ])->setStatusCode(400);
        }

        $userModel    = new UserModel();
        $teacherModel = new TeacherModel();

        // Insert into auth_user
        $userData = [
            'email'      => $this->request->getPost('email'),
            'first_name' => $this->request->getPost('first_name'),
            'last_name'  => $this->request->getPost('last_name'),
            'password'   => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
        ];

        $userId = $userModel->insert($userData);

        // Insert into teachers using the new user's id
        $teacherData = [
            'user_id'         => $userId,
            'university_name' => $this->request->getPost('university_name'),
            'gender'          => $this->request->getPost('gender'),
            'year_joined'     => $this->request->getPost('year_joined'),
            'subject'         => $this->request->getPost('subject'),
            'phone'           => $this->request->getPost('phone'),
        ];

        $teacherModel->insert($teacherData);

        return $this->response->setJSON([
            'status'  => true,
            'message' => 'Teacher created successfully'
        ])->setStatusCode(201);
    }

    public function getUsers()
    {
        $userModel = new UserModel();
        $users     = $userModel->select('id, email, first_name, last_name, created_at')->findAll();

        return $this->response->setJSON([
            'status' => true,
            'data'   => $users
        ])->setStatusCode(200);
    }

    public function getTeachers()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('teachers t');
        $builder->select('t.id, t.university_name, t.gender, t.year_joined, t.subject, t.phone, u.email, u.first_name, u.last_name');
        $builder->join('auth_user u', 'u.id = t.user_id');
        $teachers = $builder->get()->getResultArray();

        return $this->response->setJSON([
            'status' => true,
            'data'   => $teachers
        ])->setStatusCode(200);
    }
}
