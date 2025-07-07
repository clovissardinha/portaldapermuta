<?php
namespace App\Controllers\UserAdmin;

class DestaqueUser extends BaseController{

    public function index(){
        echo view('UserAdmin/Home/DestaqueUser');
    }

}