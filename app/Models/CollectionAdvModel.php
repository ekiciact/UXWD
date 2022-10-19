<?php namespace App\Models;

use CodeIgniter\Model;
use App\Models\AdventureModel;
use App\Models\AdventureLocationModel;

class CollectionAdvModel extends Model {
    protected $table = 'adventure_collection';
    protected $primaryKey = 'id_adventure_collection';
    protected $allowedFields = ['id_adventure_collection', 'id_user', 'collectionName', 'collectionPic', 'date_time'];
 
    protected $useTimestamps = true;
    protected $createdField  = 'date_time';
    protected $updatedField  = 'date_time';
 

    public function getAdventureCollection($id){
        $query_text = 'SELECT id_adventure_collection,id_user,collectionName,collectionPic FROM adventure_collection WHERE id_user = :id: ORDER BY date_time ';
        $query = $this->db->query($query_text,['id'=>$id]);
        return $query->getResult();
    }

    public function getMyAdventuresId(){
        $user = session()->get('id_user');
        $query_text = "SELECT id_adventure_collection FROM adventure_collection WHERE collectionName='My Adventures' and id_user = :id_user:";
        $query = $this->db->query($query_text, [ 'id_user' => $user]);
        $row = $query->getRow();
        return $row->id_adventure_collection;
    }

    public function get_adventures_from_collection($id){
        $query_text = 'SELECT adv.id_adv, adv.title, adv.description, adv.adv_pic FROM adv INNER JOIN adv_collection_elements ON adv.id_adv = adv_collection_elements.id_adv AND adv_collection_elements.id_adventure_collection = :id:' ; 
        $query = $this->db->query($query_text, ['id'=>$id]);
        return $query->getResult();
    }

     public function get_adv_collection_name($id){
        $query_text = 'SELECT collectionName FROM adventure_collection WHERE id_adventure_collection = :id: ';
        $query = $this->db->query($query_text,['id'=>$id]);
        return $query->getResult();
    }  

}


