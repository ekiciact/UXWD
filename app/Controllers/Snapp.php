<?php namespace App\Controllers;

use App\Models\DataBaseModel;
use \App\Models\SnappModel;
use App\Models\AdventureModel;
use \App\Models\CollectionModel;
use http\Encoding\Stream\Dechunk;

class Snapp extends BaseController
{
    private $dbmodels;
    private $advmodel;
    private $homemodel;
    private $db;
    private $data;
    private $title='title';
    public function __construct()
    {
        $this->dbmodels=new \ViewSnappAdvModel();
        $this->advmodel=new AdventureModel();
        $this->homemodel=new \HomeModel();

    }
    public function initViewDataSnapp($id,$collections1,$title1,$location_lat1,$location_lon1,$description1,$img1,$plantSpec,$Eximage)
    {
        $this->data['id']=$id;
        $this->data['percentage']=$percentage=0.7*360;
        $this->data['coll']=$collections1;
        $this->data['title']=$title1->title;
        $this->data['location_lat']=$location_lat1->location_lat;
        $this->data['location_lon']=$location_lon1->location_lon;
        $this->data['description']=$description1->snappNotes;
        $this->data['img'] = $img1->pic;
        $this->data['plant_species']=$plantSpec->plant_species;
        $this->data['ex_image']=$Eximage->example_picture_species;

    }
    public function initViewDataAdv($collections,$title,$description,$img,$locations,$comps,$id)
    {
        $this->data['coll']=$collections;
        $this->data['title']=$title->title;
        $this->data['description']=$description->description;
        $this->data['img'] = $img->adv_pic;
        $this->data['locations']=$locations;
        $this->data['comps']=$comps;
        $this->data['id']=$id;
    }

    public function index()
    {
        return view('find_a_snapp');
    }
    public function view($id)
    {
        $this->data['id']=$id;
        $row=$this->dbmodels->getSnappInfo($id);
        $collections=$this->dbmodels->getCollections(session()->get('id_user'));
        $this->initViewDataSnapp($id,$collections,$row,$row,$row,$row,$row,$row,$row);
        $this->data['page_title']='view_snapp';
        $this->data['scripts'] = ['jquery-3.5.1.js', 'materialize.js', 'common.js','view_snapp.js','leaflet.js'];
        $this->data['styles'] = ['materialize.css', 'flaticon.css','leaflet.css'];
        $id_col = $this->homemodel->getFavouritesId();
        $array_sna_f = $this->homemodel->getCollectionSanpps($id_col);
        $this->data['array_sna_f'] = $array_sna_f;
        if($this->request->getMethod()==='post') {
            $id2 = $this->request->getPost('last');
            $id1 = $this->request->getPost('collection');
            $pass=null;
            foreach ($collections as $coll)
            {
                if($id1==$coll->collectionName)
                {
                    $pass=$coll->id_collection;

                }
            }
            $data = [
                'description' => $id2,
                'id_collection' => $pass,
                'id_snapp' => $id
            ];
            $this->dbmodels->insertInDB($data,'collection_elements');
        }
        return view('Snapp/view_snapp', $this->data);
    }

    public function view_json($id)
    {
        $snappModel = new SnappModel();
        echo json_encode($snappModel->find($id));
    }

    public function view2($id)
    {
        $this->data['id']=$id;
        $row=$this->dbmodels->getSnappInfo($id);
        $collections=$this->dbmodels->getCollections(session()->get('id_user'));
        $this->initViewDataSnapp($id,$collections,$row,$row,$row,$row,$row,$row,$row);
        $this->data['page_title'] = "view_snapp";
        $this->data['scripts'] = ['jquery-3.5.1.js', 'materialize.js', 'common.js','view_snapp.js','leaflet.js'];
        $this->data['styles'] = ['materialize.css', 'flaticon.css','leaflet.css'];

        if($this->request->getMethod()==='post') {

            $id1 = $this->request->getPost('collection');

            $data2 = [
                'collectionName' => $id1,
                'id_user' => session()->get('id_user')
            ];
            $this->dbmodels->insertInDB($data2,'collections');

            echo "<meta http-equiv='refresh' content='0'>";
        }
        return view('Snapp/view_snapp', $this->data);
    }

    public function view_adv($id)
    {
        $row=$this->dbmodels->getAdvInfo($id);
        $loc=$this->advmodel->getLocation($id);
        $loccomp=$this->advmodel->getLocationComp($id);
        $collections=$this->dbmodels->getAdvCollections(session()->get('id_user'));
        $this->initViewDataAdv($collections,$row,$row,$row,$loc,$loccomp,$id);
        $this->data['location_lat']=50.8796;
        $this->data['location_lon']=4.7009;
        $this->data['page_title'] = "test title";
        $this->data['scripts'] = ['jquery-3.5.1.js', 'materialize.js', 'common.js','view_adventure.js','leaflet.js'];
        $this->data['styles'] = ['materialize.css', 'flaticon.css','leaflet.css'];
        if($this->request->getMethod()==='post') {
            $id2 = $this->request->getPost('note');
            $id1 = $this->request->getPost('collection');
            $pass=null;
            foreach ($collections as $coll)
            {
                if($id1==$coll->collectionName)
                {
                    $pass=$coll->id_adventure_collection;

                }
            }
            $data = [
                'description' => $id2,
                'id_adventure_collection' => $pass,
                'id_adv' => $id
            ];
            $this->dbmodels->insertInDB($data,'adv_collection_elements');
        }
        return view('Snapp/view_adventure', $this->data);
    }
    public function view_adv2($id)
    {
        $row=$this->dbmodels->getAdvInfo($id);
        $loc=$this->advmodel->getLocation($id);
        $collections=$this->dbmodels->getAdvCollections(session()->get('id_user'));
        $loccomp=$this->advmodel->getLocationComp($id);
        $this->initViewDataAdv($collections,$row,$row,$row,$loc,$loccomp,$id);
        $this->data['location_lat']=50.8796;
        $this->data['location_lon']=4.7009;
        $this->data['page_title'] = "test title";
        $this->data['scripts'] = ['jquery-3.5.1.js', 'materialize.js', 'common.js','view_adventure.js','leaflet.js'];
        $this->data['styles'] = ['materialize.css', 'flaticon.css','leaflet.css'];
        if($this->request->getMethod()==='post') {
            //$id2 = $this->request->getPost('last');
            $id1 = $this->request->getPost('collection');

            $data2 = [
                'collectionName' => $id1,
                'id_user' => session()->get('id_user')
            ];
            $this->dbmodels->insertInDB($data2,'adventure_collection');

            echo "<meta http-equiv='refresh' content='0'>";
        }
        return view('Snapp/view_adventure', $this->data);
    }

    public function find_a_snapp()
    {
        if($this->request->getMethod() == "post"){
            $db = db_connect();
            $lat = $this->request->getVar('lat');
            $lon = $this->request->getVar('lng');


            $sql = "SELECT id_snapp, title, location_lat, location_lon, snappNotes, plant_species, pic, like_count, ROUND(acos(sin(radians($db->escape($lat)))*sin(radians(location_lat)) + cos(radians($db->escape($lat)))*cos(radians(location_lat))*cos(radians(location_lon)- radians($db->escape($lon)))) * 6371,1) As Distance From snapps
                      order by Distance
                      limit 10";

            $returnarray = $db->query($sql)->getResultArray();

            //favorited or not;
            $id_col = $this->homemodel->getFavouritesId();
            $array_sna_f = $this->homemodel->getCollectionSanpps($id_col);

            for ($i = 0; $i < 10; $i++) {
                $returnarray[$i]['liked'] = 'favorite_border';
                foreach ($array_sna_f as $sna_f)
                    if ($returnarray[$i]['id_snapp'] == $sna_f->id_snapp) $returnarray[$i]['liked'] = 'favorite';
            }

            echo json_encode($returnarray) ;
        }
        else{
            $data['page_title'] = "Find a snapp";
            $data['scripts'] = ['jquery-3.5.1.js', 'materialize.js', 'leaflet.js', 'places.js' , 'common.js', 'find_snapp.js'];
            $data['styles'] = ['materialize.css', 'leaflet.css'];
            return view('Snapp/find_a_snapp', $data);
        }
    }

    public function create_a_snapp()
    {
        $data['page_title'] = "Create a snapp";
        $data['scripts'] = ['jquery-3.5.1.js', 'materialize.js' , 'common.js', 'croppie.js', 'animatedModal.js', 'leaflet.js', 'easy-button.js', 'mstepper.js', 'create_snapp_base.js','create_snapp.js'];
        $data['styles'] = ['croppie.css', 'animate.min.css', 'normalize.min.css', 'materialize.css', 'easy-button.css','leaflet.css'];
        return view('Snapp/create_a_snapp', $data);
    }
    public function new_snapp()
    {
        //log_message('debug', "new_snapp test php debug");
        if ($this->request->getMethod() == "post") {
            $snappModel = new SnappModel();
            $collectionModel = new CollectionModel();

            $data = [
                'title' => $this->request->getVar("snapp_title"),
                'pic' => $this->request->getVar("snapp_image"),
                'snappNotes' => $this->request->getVar("snapp_description"),
                'location_lat' => $this->request->getVar("snapp_location_lat"),
                'location_lon' => $this->request->getVar("snapp_location_lng"),
                'plant_species' => $this->request->getVar("plant_species"),
                'info_link' => $this->request->getVar("info_link"),
                'example_picture_species' => $this->request->getVar("example_picture_species"),
                'id_user' => session()->get('id_user'),
            ];
            $ret = $snappModel->insert($data);
            if ($ret) {
                $collectionID = $collectionModel->getMySnappsId();

                $data = [
                    'id_collection' => $collectionID,
                    'id_snapp' => $ret
                ];
                $this->dbmodels->insertInDB($data,'collection_elements');

                echo json_encode(array(
                    "status" => true,
                    "message" => "Snapp created",
                    "snapp_id" => $ret
                ));
            } else {

                echo json_encode(array("status" => false, "message" => "Failed to create snapp"));
            }
        }





    }
    //--------------------------------------------------------------------

}
