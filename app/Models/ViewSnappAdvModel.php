<?php


class viewSnappAdvModel extends \CodeIgniter\Model
{

    protected $db;
    protected $table='snapps';
    protected $primaryKey='id';
    protected $allowedFields = ['idcollections', 'id_user','collectionName','firstname'];
    protected $returnType = 'array';
    protected $useSoftDeletes = true;

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;


    public function __construct()
    {
        $this->db=\Config\Database::connect();
    }

    public function insertInDB($data,$dbtable)
    {
        $this->db->table($dbtable)->insert($data);
        return 1;
    }
    public function getSnappInfo($id)
    {
        $query_text = 'SELECT snappNotes,pic,title, location_lat, location_lon, plant_species, example_picture_species FROM snapps WHERE id_snapp = :id:';
        $query = $this->db->query($query_text, [ 'id' => $id]);
        $row = $query->getRow();
        return $row;
    }
    public function getAdvInfo($id)
    {
        $query_text = 'SELECT title,description,adv_pic FROM adv WHERE id_adv = :id:';
        $query = $this->db->query($query_text, [ 'id' => $id]);
        $row = $query->getRow();
        return $row;

    }
    public function getFeed()
    {
        $query_text = 'SELECT name,description,time,id_user, id_snapp FROM friendsfeed';
        $query = $this->db->query($query_text);
        $result= $query->getResult();
        return $result;
    }

    public function getCollections($id)
    {
        $query_text = 'SELECT collectionName, id_collection FROM collections WHERE id_user = :id:';
        $query = $this->db->query($query_text, [ 'id' => $id]);
        $row = $query->getResult();
        return $row;
    }
    public function getAdvCollections($id)
    {
        $query_text = 'SELECT collectionName, id_adventure_collection FROM adventure_collection WHERE id_user = :id:';
        $query = $this->db->query($query_text, [ 'id' => $id]);
        $row = $query->getResult();
        return $row;
    }
    //if you have the id of the user
    public function getCollectionsWithId($id)
    {
        $query_text = 'SELECT collectionName FROM collections WHERE id_user = :id:';
        $query = $this->db->query($query_text, [ 'id' => $id]);
        $row = $query->getResult();
        return $row;
    }

    public function getUserInfo($id)
    {
        $query_text = 'SELECT firstname, lastname, username, email, profile_image FROM users WHERE id_user = :id:';
        $query = $this->db->query($query_text, [ 'id' => $id]);
        $row = $query->getRow();
        return $row;
    }

    public function get_recent_snapps($id)
    {
        $query_text = 'SELECT id_snapp,like_count,title,pic,snappNotes,location_lat,location_lon, id_user, taken_date FROM snapps WHERE id_user = :id: ORDER BY taken_date DESC LIMIT 3';
        $query = $this->db->query($query_text, ['id' => $id]);
        $row = $query->getResult();
        return $row;
    }

    public function get_recent_adv($id){
        $query_text = 'SELECT id_adv,id_user,title,adv_pic,description,created_date, Date_Format(created_date, "%d-%m-%y") as formattedcreatedate FROM adv  WHERE published = 1 AND id_user = :id: ORDER BY created_date DESC LIMIT 3';
        $query = $this->db->query($query_text, ['id' => $id]);
        $row = $query->getResult();
        return $row;
    }

    public function getSnappCount($id){
        $query_text = 'SELECT count(id_snapp) as count FROM snapps  WHERE id_user = :id:';
        $query = $this->db->query($query_text, ['id' => $id]);
        $row = $query->getResult()[0]->count;
        return $row;
    }

    public function getAdvCount($id){
        $query_text = 'SELECT count(id_adv) as count FROM adv  WHERE id_user = :id: AND  published = 1';
        $query = $this->db->query($query_text, ['id' => $id]);
        $row = $query->getResult()[0]->count;
        return $row;
    }
}