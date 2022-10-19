<?php
namespace App\Validation;
use App\Models\UserModel;

class UserRules{
    public function validateUser(string $str, string $fields, array $data) {
        $model = new UserModel();
        $user =$model ->where('email', $data['email_username'])
                        ->first();
        if (!$user) {
            $user =$model ->where('username', $data['email_username'])
                ->first();
            if (!$user)
                return false;
        }

        return password_verify($data['password'], $user['password']);
    }
}