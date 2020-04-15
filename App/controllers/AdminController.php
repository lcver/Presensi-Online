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

    public function jadwal()
    {
        $result = $this->model('SesiModel')->create();
        if(!is_null($result)){
            $key = array_keys($result);

            $count = count($key);
            $num = NULL;

            for ($i=0; $i < $count ; $i++) { 
                if(is_numeric($key[$i])) $num = true;
            }

            // foreach ($resultkey as $key) {
            //     if(!is_numeric($key)) $num = false;
            // }
                if(!$num):
                    $data[] = $result;
                else:
                    $data = $result;
                endif;
            // var_dump($data);
            // die();
        }else{
            $data=NULL;
        }

        $this->view('admin/jadwal',$data,'admin');
    }

    public function set_jadwal()
    {
        $data = [
            'sesi' => $_POST['presensi_sesi'],
            'tanggal' => $_POST['presensi_tanggal'],
            'waktu_mulai' => $_POST['presensi_waktu_mulai'] ,
            'waktu_selesai' => $_POST['presensi_waktu_selesai']
        ];

        if(isset($_SESSION['presensi_adminsession'])){
            $res = $this->model('SesiModel')->store($data);

            if($res===true){
                Flasher::setFlash('Jadwal Berhasil Ditambahkan',true);
            }else{
                Flasher::setFlash('Jadwal Gagal Ditambahkan',false);
            }
        }
        header('location:'.BASEURL.'admin/jadwal');
    }

    public function jadwal_detail()
    {
        
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
