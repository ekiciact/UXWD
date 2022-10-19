<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model {

    protected $table= 'users';
    protected $primaryKey= 'id_user';
    protected $allowedFields = ['firstname', 'lastname', 'username', 'email', 'birthdate', 'gender', 'password', 'reg_date', 'profile_image', 'editing_adventure'];

    protected $allowCallbacks = true;
    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeInsert'];

    protected function beforeInsert(array $data){
        $data = $this->passwordHash($data);
        return $data;
    }
    public function retrieveUser($email)
    {
        $query_text = 'SELECT id_user FROM users WHERE email = :email:';
        $query = $this->db->query($query_text, [ 'email' => $email]);
        $row = $query->getRow();
        return $row;
    }

    protected function passwordHash(array $data){
        if (isset($data['data']['password']))
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        return $data;
    }




}