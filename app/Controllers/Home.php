<?php namespace App\Controllers;

use App\Models\AdventureLocationModel;

class Home extends BaseController
{
    private $homeModel;
    private $collectionModel;

    public function __construct()
    {
        $this->homeModel = new \HomeModel();
//        $this->collectionModel = new \CollectionModel();
    }

    public function index()
    {
        return view('welcome_message');
    }

    //--------------------------------------------------------------------

    public function homepage()
    {
        $data['page_title'] = "SNapp Home";
        $data['scripts'] = ['jquery-3.5.1.js', 'materialize.js' , 'common.js', 'home.js', 'croppie.js'];
        $data['styles'] = ['materialize.css', 'flaticon.css', 'croppie.css'];

//        $this->homeModel = new \HomeModel();
        $adv_top = $this->homeModel->get_adv_name();
        $adv_location_model = new AdventureLocationModel();

        foreach ($adv_top as $adventure){
            $adventure->locArray = $adv_location_model->where('adv_id', $adventure->id_adv)->findAll();
        }

        $snapp_top = $this->homeModel->get_snapps();
        $data2['adv_top'] = json_encode($adv_top);
        $data2['snapp_top'] = $snapp_top;
        if($user = session()->get('isLoggedIn'))
        {
            $id_col = $this->homeModel->getFavouritesId();
            $array_snapp = $this->homeModel->getCollectionSanpps($id_col);
            $data2['array_snapp'] = $array_snapp;
        }
        $data['content'] = view('Home/db_home', $data2);

        return view('Home/homepage', $data);
    }

    public function like_button()
    {
        if (isset($_POST['liked'])) {
            $id = $_POST['postid'];
            $likes = $this->homeModel->addLikeCount($id);
            print_r($likes);

            $id_collection = $this->homeModel->getFavouritesId();
            $data = [
                'id_collection' => $id_collection,
                'id_snapp' => $id
            ];
            $this->homeModel->insertFavourites($data);
        }
        else if (isset($_POST['unliked']))
        {
            $id = $_POST['postid'];
            $likes = $this->homeModel->decreaseLikeCount($id);
            print_r($likes);

            $id_collection = $this->homeModel->getFavouritesId();
            $data = [
                'id_collection' => $id_collection,
                'id_snapp' => $id
            ];
            $this->homeModel->removeFavourites($data);
        }
        else if (isset($_POST['liked_adv'])) {
            $id = $_POST['postid'];
            $id_adventure_collection = $this->homeModel->getAdvFavouritesId();
            $data = [
                'id_adventure_collection' => $id_adventure_collection,
                'id_adv' => $id
            ];
            $this->homeModel->insertAdvFavourites($data);
        }
        else if (isset($_POST['unliked_adv']))
        {
            $id = $_POST['postid'];
            $id_adventure_collection = $this->homeModel->getAdvFavouritesId();
            $data = [
                'id_adventure_collection' => $id_adventure_collection,
                'id_adv' => $id
            ];
            $this->homeModel->removeAdvFavourites($data);
        }
    }

}
