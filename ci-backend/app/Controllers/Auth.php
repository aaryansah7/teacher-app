<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;
use Firebase\JWT\JWT;

class Auth extends BaseController
{
    public function register()
    {
        $rules = [
            'email'      => 'required|valid_email|is_unique[auth_user.email]',
            'first_name' => 'required|min_length[2]',
            'last_name'  => 'required|min_length[2]',
            'password'   => 'required|min_length[6]',
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Validation failed',
                'errors'  => $this->validator->getErrors()
            ])->setStatusCode(400);
        }

        $model = new UserModel();

        $data = [
            'email'      => $this->request->getPost('email'),
            'first_name' => $this->request->getPost('first_name'),
            'last_name'  => $this->request->getPost('last_name'),
            'password'   => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
        ];

        $model->insert($data);

        return $this->response->setJSON([
            'status'  => true,
            'message' => 'User registered successfully'
        ])->setStatusCode(201);
    }

    public function login()
    {
        $rules = [
            'email'    => 'required|valid_email',
            'password' => 'required',
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Validation failed',
                'errors'  => $this->validator->getErrors()
            ])->setStatusCode(400);
        }

        $model = new UserModel();
        $user  = $model->where('email', $this->request->getPost('email'))->first();

        if (!$user || !password_verify($this->request->getPost('password'), $user['password'])) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Invalid email or password'
            ])->setStatusCode(401);
        }

        $key     = getenv('JWT_SECRET');
        $payload = [
            'iat'   => time(),
            'exp'   => time() + 3600,
            'id'    => $user['id'],
            'email' => $user['email'],
        ];

        $token = JWT::encode($payload, $key, 'HS256');

        return $this->response->setJSON([
            'status'  => true,
            'message' => 'Login successful',
            'token'   => $token,
            'user'    => [
                'id'         => $user['id'],
                'email'      => $user['email'],
                'first_name' => $user['first_name'],
                'last_name'  => $user['last_name'],
            ]
        ])->setStatusCode(200);
    }
}
