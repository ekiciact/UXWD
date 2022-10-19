<?php namespace App\Models;

use CodeIgniter\Model;

class AdventureModel extends Model
{

    protected $table=   'adv';
    protected $primaryKey=  'id_adv';
    protected $allowedFields = ['id_user', 'title', 'description', 'like_count', 'adv_pic', 'published'];
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $useTimestamps = true;
    protected $createdField  = 'created_date';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;



    public function insertAdv($id_user,$title, $description)
    {
        $db=\Config\Database::connect();
        $data=['id_user'=>$id_user, 'title'=>$title, 'description'=>$description];
        $this->db->table('adv')->insert($data);
        return 1;
    }

    public function insertLocation($title, $description)
    {
        $db=\Config\Database::connect();
        $data=['title'=>$title, 'description'=>$description];
        $this->db->table('adv_locations')->insert($data);
        return 1;
    }



    public function getLocation($id)
    {
        $db=\Config\Database::connect();
        $query_text = 'SELECT location_lat,location_lon,title,pic,description,id_loc, distanceToPrevious FROM adv_locations where adv_id=:id:';
        $query = $this->db->query($query_text,['id'=>$id]);
        $result= $query->getResult();
        return $result;
    }
    public function getSpecLoc($id)
    {
        $db=\Config\Database::connect();
        $query_text = 'SELECT location_lat,location_lon FROM adv_locations where id_loc=:id:';
        $query = $this->db->query($query_text,['id'=>$id]);
        $result= $query->getRow();
        return $result;
    }
    public function getLocationComp($id)
    {
        $db=\Config\Database::connect();
        $query_text = 'SELECT location_lat,location_lon FROM adv_locations where adv_id=:id: order by advorder';
        $query = $this->db->query($query_text,['id'=>$id]);
        $result= $query->getResult();
        return $result;
    }

    public function getTitle($id)
    {
        $db=\Config\Database::connect();
        $query_text = 'SELECT title FROM adv_locations WHERE id_loc = :id:';
        $query = $this->db->query($query_text, [ 'id' => $id]);
        $row = $query->getRow();
        return $row;

    }

    public function getAdvLoc($id)
    {
        $query_text = 'SELECT * FROM adv_locations WHERE id_loc = :id:';
        $query = $this->db->query($query_text, [ 'id' => $id]);
        $row = $query->getRow();
        return $row;
    }

    public function getNextAdvLoc($id)
    {
    $query_text = 'SELECT id_loc FROM adv_locations where advorder = (SELECT advorder + 1 as nextAdv FROM adv_locations WHERE id_loc = :id:) and adv_id = (SELECT adv_id FROM adv_locations WHERE id_loc = :id:)';
    $query = $this->db->query($query_text, [ 'id' => $id]);
    $row = $query->getRow();
        if ($row == NULL){
            return -1;
        }
        else{
            return $row->id_loc;
        }
    }

    public function getPrevAdvLoc($id)
    {
        $query_text = 'SELECT id_loc FROM adv_locations where advorder = (SELECT advorder - 1 as nextAdv FROM adv_locations WHERE id_loc = :id:) and adv_id = (SELECT adv_id FROM adv_locations WHERE id_loc = :id:)';
        $query = $this->db->query($query_text, [ 'id' => $id]);
        $row = $query->getRow();
        if ($row == NULL){
            return -1;
        }
        else{
            return $row->id_loc;
        }
    }

    public function getDescription($id)
    {
        $db=\Config\Database::connect();
        $query_text = 'SELECT description FROM adv_locations WHERE id_loc = :id:';
        $query = $this->db->query($query_text, [ 'id' => $id]);
        $row = $query->getRow();
        return $row;
    }

    public function getVoice($id)
    {
        $db=\Config\Database::connect();
        $query_text = 'SELECT voice FROM adv_locations WHERE id_loc = :id:';
        $query = $this->db->query($query_text, [ 'id' => $id]);
        $row = $query->getResultArray();
        return $row;
    }


}