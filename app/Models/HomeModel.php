<?php


//namespace App\Models;


class HomeModel
{
    private $db;
//    private $idd = $_SESSION['id_user'];

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function get_adv_name(){
        $query_text = 'SELECT id_adv,title,description,Date_Format(created_date, "%d-%m-%y") as formattedcreatedate FROM adv  WHERE published = 1 ORDER BY like_count DESC LIMIT 5';
        $query = $this->db->query($query_text);
        return $query->getResult();
    }

    public function get_snapps(){
        $query_text = 'SELECT id_snapp,like_count,title,pic,snappNotes,location_lat,location_lon FROM snapps ORDER BY like_count DESC LIMIT 5';
        $query = $this->db->query($query_text);
        return $query->getResult();
    }

    public function addLikeCount($id){
//
        $query_text = "UPDATE snapps SET like_count=like_count+1 WHERE id_snapp = :id:";
        $query = $this->db->query($query_text, [ 'id' => $id]);
        $query_text_2 = "SELECT like_count FROM snapps WHERE id_snapp = :id:";
        $query_2 = $this->db->query($query_text_2, [ 'id' => $id]);
        $row = $query_2->getRow();
        return $row->like_count;
    }

    public function decreaseLikeCount($id){
        $query_text = "UPDATE snapps SET like_count=like_count-1 WHERE id_snapp = :id:";
        $query = $this->db->query($query_text, [ 'id' => $id]);
        $query_text_2 = "SELECT like_count FROM snapps WHERE id_snapp = :id:";
        $query_2 = $this->db->query($query_text_2, [ 'id' => $id]);
        $row = $query_2->getRow();
        return $row->like_count;
    }

    public function getFavouritesId(){
        $user = session()->get('id_user');
        $query_text = "SELECT id_collection FROM collections WHERE collectionName='Favourites' and id_user = :id_user:";
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


    public function getAdvFavouritesId(){
        $user = session()->get('id_user');
        $query_text = "SELECT id_adventure_collection FROM adventure_collection WHERE collectionName='Favourites' and id_user = :id_user:";
        $query = $this->db->query($query_text, [ 'id_user' => $user]);
        $row = $query->getRow();
        return $row->id_adventure_collection;
    }

    public function getAdvElements($id_adventure_collection){
        $query_text = "SELECT id_adv FROM adv_collection_elements WHERE id_adventure_collection = :id_adventure_collection:";
        $query = $this->db->query($query_text, ['id_adventure_collection' => $id_adventure_collection]);
        return $query->getResult();
    }

    public function insertAdvFavourites($data){
        $this->db->table('adv_collection_elements')->insert($data);
        $query_text = "UPDATE adv SET like_count=like_count+1 WHERE id_adv = :id:";
        $query = $this->db->query($query_text, [ 'id' => $data['id_adv']]);
        return 1;
    }

    public function removeAdvFavourites($data){
        $this->db->table('adv_collection_elements')->delete($data);
        $query_text = "UPDATE adv SET like_count=like_count-1 WHERE id_adv = :id:";
        $query = $this->db->query($query_text, [ 'id' => $data['id_adv']]);
        return 1;
    }
}