<?php namespace App\Models;

use CodeIgniter\Model;

class AdventureLocationModel extends Model
{
    protected $table      = 'adv_locations';
    protected $primaryKey = 'id_loc';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['title', 'description', 'voice', 'pic', 'location_lat', 'location_lon', 'adv_id', 'plant_species', 'advorder', 'distanceToPrevious'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    //protected $deletedField  = 'deleted_at';

    //protected $allowCallbacks = true;
    //protected $afterInsert = []

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}