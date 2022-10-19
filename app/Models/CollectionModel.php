<?php namespace App\Models;

use CodeIgniter\Model;
use App\Models\SnappModel;

class CollectionModel extends Model {
    protected $table = 'collections';
    protected $primaryKey = 'id_collection';
    protected $allowedFields = ['id_user', 'id_collection', 'collectionName', 'collectionPicture', 'date_time'];

    protected $useTimestamps = true;
    protected $createdField  = 'date_time';
    protected $updatedField  = 'date_time';

    public function getUserCollections()
    {
        $query_text = 'SELECT name,description,time FROM friendsfeed';
        $query = $this->db->query($query_text);
        $result= $query->getResult();
        return $result;
    }
    public function addNewColl($data)
    {
        $this->db->table('collections')->insert($data);
        return 1;
    }

    public function get_collections($id){
        $query_text = 'SELECT id_collection,id_user,collectionName,collectionPicture FROM collections WHERE id_user = :id: ORDER BY date_time ';
        $query = $this->db->query($query_text,['id'=>$id]);
        return $query->getResult();
    }

    public function get_snapps_from_collection($id){
        $query_text = 'SELECT id_collection,id_snapp,description,date_time FROM collection_elements WHERE id_collection = :id:' ; 
        $query = $this->db->query($query_text, ['id'=>$id]);
        return $query->getResult();
    }

    public function getFavouritesId(){
        $user = session()->get('id_user');
        $query_text = "SELECT id_collection FROM collections WHERE collectionName='Favourites' and id_user = :id_user:";
        $query = $this->db->query($query_text, [ 'id_user' => $user]);
        $row = $query->getRow();
        return $row->id_collection;
    }

    public function getMySnappsId(){
        $user = session()->get('id_user');
        $query_text = "SELECT id_collection FROM collections WHERE collectionName='My SNapp\'s' and id_user = :id_user:";
        $query = $this->db->query($query_text, [ 'id_user' => $user]);
        $row = $query->getRow();
        return $row->id_collection;
    }

    public function getCollectionSanpps($id_collection){
        $query_text = "SELECT id_snapp FROM collection_elements WHERE id_collection = :id_collection:";
        $query = $this->db->query($query_text, ['id_collection' => $id_collection]);
        return $query->getResult();
    } 

    public function insertFavourites($data){
        $this->db->table('collection_elements')->insert($data);
        return 1;
    }

    public function removeFavourites($data){
        $this->db->table('collection_elements')->delete($data);
        return 1;
    }

    public function get_collection_name($id){
        $query_text = 'SELECT collectionName FROM collections WHERE id_collection = :id: ';
        $query = $this->db->query($query_text,['id'=>$id]);
        return $query->getResult();
    }

    public function get_collectionSNapps($id_collection){
        $query_text = 'SELECT snapps.id_snapp, snapps.title, snapps.pic, snapps.snappNotes FROM snapps INNER JOIN collection_elements ON snapps.id_snapp = collection_elements.id_snapp AND collection_elements.id_collection = :id_collection: ';
        $query = $this->db->query($query_text,['id_collection' => $id_collection]);
        return $query->getResult();
    }

}


