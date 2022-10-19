<?php namespace App\Models;

use CodeIgniter\Model;
use App\Models\SnappModel;
use App\Models\CollectionModel;

class CollectionElementAdvModel extends Model {
    protected $table = 'adv_collection_elements';
    protected $primaryKey = 'id_adv';
    protected $allowedFields = ['id_adventure_collection', 'id_adv', 'description', 'date_time'];

}