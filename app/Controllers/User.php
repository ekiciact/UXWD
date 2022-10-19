<?php namespace App\Controllers;

use App\Models\UserModel;
use Config\Services;
use ReflectionException;
use App\Models\CollectionModel;
use App\Models\CollectionAdvModel;
use App\Models\AdventureLocationModel;

class User extends BaseController
{

    private $dbmodel;

    public function __construct()
    {
        $this->dbmodel = new \ViewSnappAdvModel();
    }

    public function login()
    {
        $data = [];
        helper(['form']);

        if ($this->request->getMethod() == 'post') {
            //validation rules
            $rules = [
                'email_username' => 'required|min_length[3]|max_length[50]',
                'password' => 'required|min_length[8]|max_length[255]|validateUser[email_username,password]',
            ];

            $errors = [
                'password' => [
                    'validateUser' => 'Email/Username and/or Password don\'t match'
                ]
            ];
            if (!$this->validate($rules, $errors)) {
                $data['validation'] = $this->validator;

            } else {
                $model = new UserModel();
                $user = $model->where('username', $this->request->getVar('email_username'))
                    ->first();
                if (!$user) $user = $model->where('email', $this->request->getVar('email_username'))
                    ->first();

                $this->setUserSession($user);

                ob_start();
                header("Location: " . base_url() . "/");
                ob_end_flush();
                die();
            }

        }

        if (isset($_SESSION['isLoggedIn']) && $_SESSION["isLoggedIn"] == true) {
            ob_start();
            header("Location: " . base_url() . "/");
            ob_end_flush();
            die();
        } else {
            $data['page_title'] = "Login";
            $data['scripts'] = ['jquery-3.5.1.js', 'materialize.js', 'common.js', 'reg.js'];
            $data['styles'] = ['materialize.css', 'flaticon.css', 'commonStyling.css'];
            echo view('User/login', $data);
        }


    }

    private function setUserSession($user)
    {
        $data = [
            'id_user' => $user['id_user'],
            'firstname' => $user['firstname'],
            'lastname' => $user['lastname'],
            'username' => $user['username'],
            'email' => $user['email'],
            'birthdate' => $user['birthdate'],
            'gender' => $user['gender'],
            'reg_date' => $user['reg_date'],
            'isLoggedIn' => true,
            'profile_image' => $user['profile_image'],
            'editing_adventure' => $user['editing_adventure']
        ];

        session()->set($data);
        return true;
    }

    public function register()
    {
        $data = [];
        $defaultPic = "data:image/png;base64,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 ";

        helper(['form']);

        if ($this->request->getMethod() == 'post') {
            //validation rules
            $rules = [
                'firstname' => 'required|min_length[3]|max_length[20]',
                'lastname' => 'required|min_length[3]|max_length[20]',
                'username' => 'required|min_length[3]|max_length[10]|is_unique[users.username]',
                'email' => 'required|min_length[6]|max_length[50],valid_email|is_unique[users.email]',
                'birthdate' => 'required',
                'gender' => 'required',
                'password' => 'required|min_length[8]|max_length[255]',
                'password_confirm' => 'matches[password]',
            ];
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                //store the user in the database
                $model = new UserModel();
                $sendTo = $this->request->getVar('email');
                $firstname = $this->request->getVar('firstname');
                $newData = [
                    'firstname' => $this->request->getVar('firstname'),
                    'lastname' => $this->request->getVar('lastname'),
                    'username' => $this->request->getVar('username'),
                    'email' => $this->request->getVar('email'),
                    'birthdate' => $this->request->getVar('birthdate'),
                    'gender' => $this->request->getVar('gender'),
                    'password' => $this->request->getVar('password'),
                    'profile_image' => $defaultPic
                ];
                $model->save($newData);
                $confirmEmail = \Config\Services::email();
                $confirmEmail->setFrom('info@snapp.com', 'snapp');
                $confirmEmail->setTo($sendTo);
                $confirmEmail->setSubject('Registration');
                $confirmEmail->setMessage('Congratulation ' . $firstname . ' with your registration, we hope you will enjoy your journey on Snapp!');
                $confirmEmail->send();
                $modeluser = new UserModel();
                $user = $modeluser->where('username', $newData['username'])
                    ->first();

                $this->setUserSession($user);

                $model2 = new CollectionModel;
                $model3 = new CollectionAdvModel;
                $userid = session()->get('id_user');

                $collName1 = "My SNapp's";
                $collPic1 = $defaultPic;

                $collName2 = "Favourites";
                $collPic2 = "data:image/png;base64,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";

                $dataColl1 = [
                    'id_user' => $userid,
                    'collectionName' => $collName1,
                    'collectionPicture' => $collPic1,
                ];

                $dataColl2 = [
                    'id_user' => $userid,
                    'collectionName' => $collName2,
                    'collectionPicture' => $collPic2,
                ];

                $model2->save($dataColl1);
                $model2->save($dataColl2);

                $collName3 = "My Adventures";

                $dataColl3 = [
                    'id_user' => $userid,
                    'collectionName' => $collName3,
                    'collectionPic' => $collPic1,
                ];

                $dataColl4 = [
                    'id_user' => $userid,
                    'collectionName' => $collName2,
                    'collectionPic' => $collPic2,
                ];

                $model3->save($dataColl3);
                $model3->save($dataColl4);

                ob_start();
                header("Location: " . base_url() . "/");
                ob_end_flush();
                die();
            }
        }

        $data['page_title'] = "Register";
        $data['scripts'] = ['jquery-3.5.1.js', 'materialize.js', 'common.js', 'reg.js'];
        $data['styles'] = ['materialize.css', 'flaticon.css', 'commonStyling.css'];
        return view('User/register', $data);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('User/login');
    }

    public function passwordforgot()
    {
        function randomPassword()
        {
            $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
            $pass = array(); //remember to declare $pass as an array
            $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
            for ($i = 0; $i < 8; $i++) {
                $n = rand(0, $alphaLength);
                $pass[] = $alphabet[$n];
            }
            return implode($pass); //turn the array into a string
        }

        if ($this->request->getMethod() == 'post') {
            $resetModel = new UserModel;
            $pass = randomPassword();
            $sendTo = $this->request->getPost('email_username');
            $userId = $resetModel->retrieveUser($sendTo);
            $userId = json_decode(json_encode($userId), true);
            $user_info = $resetModel->find($userId);
            $data2 = [
                'id_user' => $user_info[0],
                'password' => $pass,

            ];
            $resetModel->save($data2);
            $resetEmail = \Config\Services::email();
            $resetEmail->setFrom('info@snapp.com', 'snapp');
            $resetEmail->setTo($sendTo);
            $resetEmail->setSubject('reinit password');
            $resetEmail->setMessage('Here is your new password, use it to login again!<br><br>' . $pass);
            ob_start();
            header('Location:' . base_url());
            ob_end_flush();
            die();
        }

        $data['page_title'] = "test title";
        $data['scripts'] = ['jquery-3.5.1.js', 'materialize.js', 'common.js', 'reg.js'];
        $data['styles'] = ['materialize.css', 'flaticon.css', 'commonStyling.css'];
        return view('User/passwordforgot', $data);
    }

    public function profile()
    {

        $id_user = session()->get('id_user');

        $userInfo = $this->dbmodel->getUserInfo($id_user);
        $snappCount = $this->dbmodel->getSnappCount($id_user);
        $advCount = $this->dbmodel->getAdvCount($id_user);

        $recentSnapps = $this->dbmodel->get_recent_snapps($id_user);
        $recentAdv = $this->dbmodel->get_recent_adv($id_user);

        $adv_location_model = new AdventureLocationModel();

        foreach ($recentAdv as $adventure){
            $adventure->locArray = $adv_location_model->where('adv_id', $adventure->id_adv)->findAll();
        }



        $data['firstname'] = $userInfo->firstname;
        $data['lastname'] = $userInfo->lastname;
        $data['username'] = $userInfo->username;
        $data['email'] = $userInfo->email;
        $data['profile_image'] = $userInfo->profile_image;
        $data['snappCount'] = $snappCount;
        $data['advCount'] = $advCount;

        $dataRecent['snapp_top'] = $recentSnapps;
        $dataRecent['adv_top'] = json_encode($recentAdv) ;
        $dataRecent['title1'] = "Most recent SNapps";
        $dataRecent['title2'] = "Most recent adventures";


        $data['content'] = view('Home/db_home', $dataRecent);


        //store profile_image
        if ($this->request->getMethod() == 'post') {
            $model = new UserModel();

            $newData = [
                'profile_image' => $this->request->getVar('profile_image')
            ];


            $model->update($id_user, $newData);
            session()->set($newData);
        }
        // ------------------------------
        $data['page_title'] = "Profile";
        $data['scripts'] = ['jquery-3.5.1.js', 'materialize.js', 'common.js', 'leaflet.js', 'easy-button.js', 'home.js', 'profile.js'];
        $data['styles'] = ['materialize.css', 'flaticon.css'];
        return view('User/profile', $data);
    }


    public function edit()
    {
        $id_user = session()->get('id_user');
        $data['page_title'] = "Edit profile";
        $data['scripts'] = ['jquery-3.5.1.js', 'materialize.js', 'common.js', 'reg.js'];
        $data['styles'] = ['materialize.css', 'flaticon.css'];

        helper(['form']);

        $newData = [
            'firstname' => $this->request->getVar('firstname'),
            'lastname' => $this->request->getVar('lastname'),
            'username' => $this->request->getVar('username'),
            'email' => $this->request->getVar('email'),
            'birthdate' => $this->request->getVar('birthdate'),
        ];

        //rules
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'firstname' => 'required|min_length[3]|max_length[20]',
                'lastname' => 'required|min_length[3]|max_length[20]',
                'username' => 'required|min_length[3]|max_length[10]',
                'email' => 'required|min_length[6]|max_length[50],valid_email',
                'birthdate' => 'required',

            ];

            // Password not changed
            if (!empty($_POST['password'])) {
                $rules = [
                    'password' => 'min_length[8]|max_length[255]',
                    'password_confirm' => 'matches[password]'
                ];
                $newdata['password'] = $this->request->getVar('password');
            }

            //unique rules
            if ($_POST['username'] !== session()->get('username')) {
                $uniqueUsername = [
                    'username' => ['rules' => 'is_unique[users.username]']
                ];
                if (!$this->validate($uniqueUsername)) {
                    $data['validation'] = $this->validator;
                    return view('User/edit', $data);
                }
            }
            if ($_POST['email'] !== session()->get('email')) {
                $uniqueEmail = ['email' => ['rules' => 'is_unique[users.email]']
                ];
                if (!$this->validate($uniqueEmail)) {
                    $data['validation'] = $this->validator;
                    return view('User/edit', $data);
                }
            }

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                //store the user in the database
                $model = new UserModel();
                $model->update($id_user,$newData);
                session()->set($newData);

                ob_start();
                header("Location: " . base_url() . "/");
                ob_end_flush();
                die();
            }
        }
        return view('User/edit', $data);
    }

    public function my_collection()
    {
        $CollectionModel = model('App\Models\CollectionModel');
        $coll = $CollectionModel->get_collections(session()->get('id_user'));
        $data = [];
        helper(['form']);
        $data['collection'] = $coll;
        $data['page_title'] = "SNapp Collection";
        $data['scripts'] = ['jquery-3.5.1.js', 'materialize.js', 'common.js'];
        $data['styles'] = ['materialize.css', 'flaticon.css'];
        return view('User/my_collection', $data);
    }

    public function my_collection_adventures()
    {
        helper(['form']);

        $CollectionModel = model('App\Models\CollectionAdvModel');
        $coll = $CollectionModel->getAdventureCollection(session()->get('id_user'));

        $data = [];
        $data['collection'] = $coll;
        $data['page_title'] = "Adventure Collection";
        $data['scripts'] = ['jquery-3.5.1.js', 'materialize.js', 'common.js'];
        $data['styles'] = ['materialize.css', 'flaticon.css'];
        return view('User/my_collection', $data);
    }


    public function view_collection($idcoll)
    {
        helper(['form']);

        $CollectionModel = model('App\Models\CollectionModel');
        $CollectionModelElement = model('App\Models\CollectionElementModel');
        $collName = $CollectionModel->get_collection_name($idcoll);//gets the collection name from the selected collection from my_collection page
        $collectionSNapps = $CollectionModel->get_collectionSNapps($idcoll); // Pulls all the snapps from the selected collection.

        $data = [];
        $data['collname'] = $collName[0];
        $data['coll_ID'] = $idcoll;
        $data['collectionElements'] = $collectionSNapps;
        $data['page_title'] = "View SNapp Collection";
        $data['scripts'] = ['jquery-3.5.1.js', 'materialize.js', 'common.js'];
        $data['styles'] = ['materialize.css', 'flaticon.css'];

        if($this->request->getMethod() === 'post')
        {
            $id=$this->request->getPost('snapp_id');
            $CollectionModelElement->delete($id);
            ob_start();
            header('Location:' . base_url() . '/User/view_collection/' . $idcoll);
            ob_end_flush();
            die();
        }

            return view('User/view_collection', $data);
    }


    public function view_adventure_collection($idcoll){
        helper(['form']);

        $CollectionModel = model('App\Models\CollectionAdvModel');
        $collName = $CollectionModel->get_adv_collection_name($idcoll);//gets the collection name from the selected collection from my_collection page
        $collectionAdventures = $CollectionModel->get_adventures_from_collection($idcoll); // Pulls all the adventures from the selected collection.

        $data = [];
        $data['coll_id'] = $idcoll;
        $data['collname'] = $collName[0];
        $data['collectionElements'] = $collectionAdventures;
        $data['page_title'] = "View Adventure Collection";
        $data['scripts'] = ['jquery-3.5.1.js', 'materialize.js', 'common.js'];
        $data['styles'] = ['materialize.css', 'flaticon.css'];

        if($this->request->getMethod() === 'post')
        {
            $id=$this->request->getPost('adv_id');
            $CollectionModel->delete($id);
            ob_start();
            header('Location:'. base_url() .'/User/view_adventure_collection/'.$idcoll);
            ob_end_flush();
            die();
        }

        return view('User/view_collection', $data);
    }

    public function view_adventure_collection_json($idcoll)
    {


        $CollectionModel = model('App\Models\CollectionAdvModel');
        $adventuresArray = $CollectionModel->get_adventures_from_collection($idcoll);

        $adv_location_model = new AdventureLocationModel();
        foreach ($adventuresArray as $adventure){
            $adventure->locArray = $adv_location_model->where('adv_id', $adventure->id_adv)->findAll();
        }
        echo json_encode($adventuresArray);
    }


    public
        function create_collection()
        {
            helper(['form']);
            $CollectionModel = model('App\Models\CollectionModel');
            $coll = $CollectionModel->get_collections(session()->get('id_user'));
            $data['Usercollections'] = $coll;

            if ($this->request->getMethod() == 'post') {


                $CollectionModel = model('App\Models\CollectionModel');
                $userColl = session()->get('id_user');
                $collPic = base_url('assets/images/plant.png');

                $newData = [
                    'id_user' => $userColl,
                    'collectionName' => $this->request->getVar('collectionName'),
                    'collectionPicture' => $collPic,
                ];

                //$CollectionModel->new_collection($newData);
                try {
                    $CollectionModel->save($newData);
                } catch (ReflectionException $e) {
                }


                ob_start();
                header('Location:' . base_url() . '/User/my_collection');
                ob_end_flush();
                die();

            }

            $data['page_title'] = "Create SNapp Collections";
            $data['scripts'] = ['jquery-3.5.1.js', 'materialize.js', 'common.js'];
            $data['styles'] = ['materialize.css', 'flaticon.css'];
            return view('User/create_collection', $data);
        }

        public
        function create_adv_collection()
        {
            helper(['form']);
            $CollectionModel = model('App\Models\CollectionAdvModel');
            $coll = $CollectionModel->getAdventureCollection(session()->get('id_user'));
            $data['Usercollections'] = $coll;

            if ($this->request->getMethod() == 'post') {


                $CollectionModel = model('App\Models\CollectionAdvModel');
                $userColl = session()->get('id_user');
                $collPic = base_url('assets/images/hiking.png');

                $newData = [
                    'id_user' => $userColl,
                    'collectionName' => $this->request->getVar('collectionName'),
                    'collectionPic' => $collPic,
                ];

                try {
                    $CollectionModel->save($newData);
                } catch (ReflectionException $e) {
                }


                ob_start();
                header('Location:' . base_url() . '/User/my_collection_adventures');
                ob_end_flush();
                die();

            }

            $data['page_title'] = "Create Adventure Collections";
            $data['scripts'] = ['jquery-3.5.1.js', 'materialize.js', 'common.js'];
            $data['styles'] = ['materialize.css', 'flaticon.css'];
            return view('User/create_collection', $data);
        }

        public
        function friendsfeed()
        {
            $feed = $this->dbmodel->getFeed();
            $data['feed'] = $feed;
            $data['page_title'] = "friendsFeed";
            $data['scripts'] = ['jquery-3.5.1.js', 'materialize.js', 'common.js'];
            $data['styles'] = ['materialize.css', 'flaticon.css', 'customfont.css'];
            return view('User/friendsfeed', $data);
        }
//--------------------------------------------------------------------

    }
