<?php namespace App\Models;

use CodeIgniter\Model;

class SnappModel extends Model
{
    protected $table      = 'snapps';
    protected $primaryKey = 'id_snapp';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['title', 'pic', 'snappNotes', 'location_lat', 'location_lon', 'id_user', 'info_link', 'plant_species', 'example_picture_species'];

    protected $useTimestamps = true;
    protected $createdField  = 'taken_date';
    protected $updatedField  = 'updated_at';
    //protected $deletedField  = 'deleted_at';

    //protected $allowCallbacks = true;
    //protected $afterInsert = []

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}


