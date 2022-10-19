<?php namespace App\Controllers;


use App\Models\AdventureLocationModel;
use App\Models\AdventureModel;
use App\Models\UserModel;

use App\Models\CollectionAdvModel;

class Adventure extends BaseController
{
    private $dbmodel;
    private $homemodel;


    public function __construct()
    {
        $this->dbmodel = new AdventureModel();
        $this->homemodel=new \HomeModel();
    }

    public function index()
    {
        return view('welcome_message');
    }

    public function create_an_adventure()
    {
        $id_user = session()->get('id_user');
        $data = [];
        if (!session()->has('editing_adventure') || session()->get('editing_adventure') == null) {
            $adventureModel = new AdventureModel();
            $userModel = new UserModel();
            $data = ['id_user' => $id_user];
            $ret = $adventureModel->insert($data);
            $data['description'] = "";
            $data['title'] = "";
            $userModel->update($id_user, ['editing_adventure' => $ret]);
            session()->set('editing_adventure', $ret);
        } else {
            $adventureModel = new AdventureModel();
            $returnfromdb = $adventureModel->find(session()->get('editing_adventure'));
            $data['description'] = (string)$returnfromdb['description'];
            $data['title'] = (string)$returnfromdb['title'];
        }

        if ($this->request->getMethod() === 'post') {
            $id1 = $this->request->getPost('title_adv');
            $id2 = $this->request->getPost('description_adv');
            $id3 = $this->request->getPost('title_loc');
            $id4 = $this->request->getPost('description_loc');

            $dbmodel->insertAdv($id_user, $id1, $id2);
            $dbmodel->insertLocation($id3, $id4);
            //$this->dbmodel->insertInDB($data);
        }

        $CollectionModel = model('App\Models\CollectionModel');
        $coll = $CollectionModel->get_collections(session()->get('id_user'));

        $data['collection'] = $coll;
        $data['page_title'] = "Create an adventure";
        $data['scripts'] = ['jquery-3.5.1.js', 'materialize.js', 'animatedModal.js', 'leaflet.js', 'places.js', 'croppie.js', 'easy-button.js', 'common.js', 'mstepper.js', 'create_snapp_base.js', 'create_adv.js'];
        $data['styles'] = ['animate.min.css', 'normalize.min.css', 'croppie.css', 'materialize.css', 'leaflet.css'];

        return view('Adventure/create_an_adventure', $data);
    }

    public function get_collection_snapps($idcoll)
    {
        $CollectionModel = model('App\Models\CollectionModel');
        $collName = $CollectionModel->get_collection_name($idcoll);//gets the collection name from the selected collection from my_collection page
        $collectionSNapps = $CollectionModel->get_collectionSNapps($idcoll); // Pulls all the snapps from the selected collection.

        $data = [];
        $data['collname'] = $collName[0];
        $data['coll_ID'] = $idcoll;
        $data['collectionElements'] = $collectionSNapps;
        echo json_encode($data);
    }

    public function add_adventure_location()
    {
        if (!session()->has('editing_adventure') || session()->get('editing_adventure') == null) {
            log_message('error', "no open adventure");
        } else {
            $adv_location_model = new AdventureLocationModel();

            $arrayOfadv = $adv_location_model->where('adv_id', session()->get('editing_adventure'))->orderBy('advorder', 'DESC')->first('array');
            if($arrayOfadv == null){
                $newIndex = 0;
                $distanceToPrevious = 0;
            }
            else{
                $newIndex = $arrayOfadv['advorder'] + 1;
                $distanceToPrevious = $this->distance($arrayOfadv['location_lat'],$arrayOfadv['location_lon'],$this->request->getVar('location_lat'),$this->request->getVar('location_lon'));
            }

            $data = [
                'title' => $this->request->getVar('title'),
                'description' => $this->request->getVar('description'),
                'voice' => $this->request->getVar('voice'),
                'pic' => $this->request->getVar('pic'),
                'location_lat' => $this->request->getVar('location_lat'),
                'location_lon' => $this->request->getVar('location_lon'),
                'plant_species' => $this->request->getVar('plant_species'),
                'adv_id' => session()->get('editing_adventure'),
                'advorder' => $newIndex,
                'distanceToPrevious' => $distanceToPrevious

            ];
            $ret = $adv_location_model->insert($data);
            if ($ret) {
                echo json_encode(array(
                    "status" => true,
                    "message" => "Location created",
                    "Location_id" => $ret
                ));
            } else {
                echo json_encode(array("status" => false, "message" => "Failed to create snapp"));
            }

        }
    }

    public function get_adventure_locations()
    {
        if (!session()->has('editing_adventure') || session()->get('editing_adventure') == null) {
            log_message('error', "no open adventure");
        } else {
            $adv_location_model = new AdventureLocationModel();
            echo (json_encode($adv_location_model->where('adv_id', session()->get('editing_adventure'))->orderBy('advorder', 'asc')->findAll())) ;
        }
    }

    public function save_adventure()
    {
        if (!session()->has('editing_adventure') || session()->get('editing_adventure') == null) {
            log_message('error', "no open adventure");
        } else {
            $adv_model = new AdventureModel();
            $data = [
                'title' => $this->request->getVar('title'),
                'description' => $this->request->getVar('description'),
            ];
            $ret = $adv_model->update(session()->get('editing_adventure'), $data);
            if ($ret) {
                echo json_encode(array(
                    "status" => true,
                    "message" => "Location created",
                    "Adventure_id" => $ret
                ));
            } else {
                echo json_encode(array("status" => false, "message" => "Failed to create snapp"));
            }
        }
    }

    public function submit_adventure()
    {
        if (!session()->has('editing_adventure') || session()->get('editing_adventure') == null) {
            log_message('error', "no open adventure");
        } else {
            $adv_model = new AdventureModel();
            $userModel = new UserModel();
            $id_user = session()->get('id_user');

            $data = [
                'title' => $this->request->getVar('title'),
                'description' => $this->request->getVar('description'),
                'published' => true
            ];
            $ret = $adv_model->update(session()->get('editing_adventure'), $data);
            $userModel->update($id_user, ['editing_adventure' => null]);



            if ($ret) {
                $collectionAdvModel = new CollectionAdvModel();
                $myAdventuresId = $collectionAdvModel->getMyAdventuresId();
                $data = [
                    'id_adventure_collection' => $myAdventuresId,
                    'id_adv' => session()->get('editing_adventure')
                ];

                $db = \Config\Database::connect();
                $db->table('adv_collection_elements')->insert($data);
                session()->remove('editing_adventure');
                echo json_encode(array(
                    "status" => true,
                    "message" => "Location created",
                    "Adventure_id" => $ret
                ));
            } else {
                echo json_encode(array("status" => false, "message" => "Failed to create snapp"));
            }
        }
    }


    public function find_an_adventure()
    {
        $adv_location_model = new AdventureLocationModel();

        if ($this->request->getMethod() == "post") {
            $db = db_connect();
            $lat = $this->request->getVar('lat');
            $lon = $this->request->getVar('lng');
/*
              $sql = "SELECT adv.id_adv, adv.title, adv.description, adv.like_count, adv_locations.title as title_loc, adv_locations.description as description_loc, adv_locations.pic, adv_locations.location_lat, adv_locations.location_lon,
                    ROUND(acos(sin(radians($db->escape($lat)))*sin(radians(adv_locations.location_lat)) + cos(radians($db->escape($lat)))*cos(radians(adv_locations.location_lat))*cos(radians(adv_locations.location_lon)- radians($db->escape($lon)))) * 6371,1) As Distance
                    FROM adv_locations INNER JOIN adv ON adv.id_adv = adv_locations.adv_id WHERE advorder = 0 AND adv.published = 1
                    order by Distance
                    limit 10";
 */
            $sql = "SELECT adv.id_adv, adv.title, adv.description, adv.like_count, adv_locations.location_lat, adv_locations.location_lon, 
                    ROUND(acos(sin(radians($db->escape($lat)))*sin(radians(adv_locations.location_lat)) + cos(radians($db->escape($lat)))*cos(radians(adv_locations.location_lat))*cos(radians(adv_locations.location_lon)- radians($db->escape($lon)))) * 6371,1) As Distance
                    FROM adv_locations INNER JOIN adv ON adv.id_adv = adv_locations.adv_id WHERE advorder = 0 AND adv.published = 1
                    order by Distance
                    limit 10";
            $adventuresArray = $db->query($sql)->getResult();

            $id_col = $this->homemodel->getAdvFavouritesId();
            $array_adv_f = $this->homemodel->getAdvElements($id_col);

            foreach ($adventuresArray as $adventure){
                $adventure->locArray = $adv_location_model->where('adv_id', $adventure->id_adv)->findAll();

                $adventure->liked = 'favorite_border';
                foreach ($array_adv_f as $adv_f){
                    if ($adventure->id_adv == $adv_f->id_adv) $adventure->liked = 'favorite' ;
                }
            }

            echo json_encode($adventuresArray);


        } else {

            $data['page_title'] = "Discover adventures";
            $data['scripts'] = ['jquery-3.5.1.js', 'materialize.js', 'leaflet.js', 'places.js', 'common.js', 'find_adventure.js'];
            $data['styles'] = ['flaticon.css', 'materialize.css', 'leaflet.css'];
            return view('Adventure/find_an_adventure', $data);
        }
    }

    public function view_location($id)
    {
        $adv_location_model = new AdventureLocationModel();
        $voice = $adv_location_model->find($id)['voice'];
        $description = $this->dbmodel->getDescription($id);
        $specLoc = $this->dbmodel->getSpecLoc($id);
        $this->data['location_lat'] = $specLoc->location_lat;
        $this->data['location_lon'] = $specLoc->location_lon;
        $this->data['description'] = $description->description;
        $this->data['voice'] = $voice;
        $this->data['advloc'] = $this->dbmodel->getAdvLoc($id);
        $this->data['nextadv'] = $this->dbmodel->getNextAdvLoc($id);
        $this->data['prevadv'] = $this->dbmodel->getPrevAdvLoc($id);

        $this->data['page_title'] = "View location";
        $this->data['scripts'] = ['jquery-3.5.1.js', 'materialize.js', 'leaflet.js', 'places.js', 'common.js', 'view_snapp.js'];
        $this->data['styles'] = ['flaticon.css', 'animate.min.css', 'normalize.min.css', 'materialize.css', 'leaflet.css'];
        return view('Adventure/view_location', $this->data);
    }

    private function distance($lat1, $lon1, $lat2, $lon2)
    {
        $pi80 = M_PI / 180;
        $lat1 *= $pi80;
        $lon1 *= $pi80;
        $lat2 *= $pi80;
        $lon2 *= $pi80;
        $r = 6372.797; // mean radius of Earth in km
        $dlat = $lat2 - $lat1;
        $dlon = $lon2 - $lon1;
        $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlon / 2) * sin($dlon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $km = number_format($r * $c);
        return $km;
    }


}
