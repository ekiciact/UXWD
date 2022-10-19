<?php namespace App\Controllers;

use App\Models\UserModel;
use Config\Services;
use ReflectionException;
use App\Models\CollectionModel;

class Language extends BaseController
{



    public function switch()
    {
        $lng = $this->request->getVar('pref_lang');
        $session = \Config\Services::session();
        $session->set('pref_lang', $lng);


//
//        $url = $_SERVER['HTTP_REFERER'];
//        redirect($url);

        ob_start();
        header("Location: ".base_url()."/");
        ob_end_flush();
        die();

//        header("Refresh:0");
    }
    }