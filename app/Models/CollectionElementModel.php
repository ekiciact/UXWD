<?php namespace App\Models;

use CodeIgniter\Model;
use App\Models\SnappModel;
use App\Models\CollectionModel;

class CollectionElementModel extends Model {
    protected $table = 'collection_elements';
    protected $primaryKey = 'id_snapp';
    protected $allowedFields = ['id_collection', 'id_snapp', 'description', 'date_time'];

}


