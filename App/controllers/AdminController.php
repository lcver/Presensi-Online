<?php

use App\Core\Controller;

class AdminController extends Controller
{
    public function index()
    {
        if(!isset($_SESSION['presensi_adminsession'])){
            self::auth();
            return false;
        }
        $this->view('admin/index',[],'admin');
    }

    public function auth()
    {
        $this->view('authentication/index',[],'self');
        if(isset($_SESSION['presensi_wrong'])){
            unset($_SESSION['presensi_wrong']);
        }
    }

    public function auth_entry_password()
    {
        $pass = "presensionlineasramappgjakartapusatadminlogin";
        if($pass!==$_POST['presensi_password'])
        {
            $_SESSION['presensi_wrong'] = true;
        }else{
            $_SESSION['presensi_adminsession'] = "Admin PPG";
        }
        header('location:'.BASEURL.'admin');
    }

    public function auth_logout()
    {
        unset($_SESSION['presensi_adminsession']);
        session_destroy();

        header('location:'.BASEURL.'admin');
    }
}
