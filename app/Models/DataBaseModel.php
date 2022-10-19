<?php

class DataBaseModel extends \CodeIgniter\Model
{

    protected $db;
    protected $table='dummy_table';
    protected $primaryKey='id';
    protected $allowedFields = ['EditField', 'age'];
    protected $returnType = 'array';
    protected $useSoftDeletes = true;

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'name';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;


    public function __construct()
    {
        $this->db=\Config\Database::connect();
    }

    public function insertInDB($data)
    {

        $this->db->table('collection_elements')->insert($data);
        return 1;
    }
    public function getImage($id)
    {
        $query_text = 'SELECT pic FROM snapps WHERE id_snapp = :id:';
        $query = $this->db->query($query_text, [ 'id' => $id]);
        $row = $query->getRow();
        return $row;
    }
    public function getDescription($id)
    {
        $query_text = 'SELECT snappNotes FROM snapps WHERE id_snapp = :id:';
        $query = $this->db->query($query_text, [ 'id' => $id]);
        $row = $query->getRow();
        return $row;

    }
    public function getFeed()
    {
        $query_text = 'SELECT name,description,time FROM friendsfeed';
        $query = $this->db->query($query_text);
        $result= $query->getResult();
        return $result;
    }


}