<?php
namespace Admin;

use App\Core\Controller;
use \Helper as Helper;
use \Flasher as Flasher;

class Sesi extends Controller
{
    private $data;

    public function __destruct()
    {
        $this->view('admin/sesi',$this->data,'admin');
    }

    public function index()
    {
        $result = $this->model('SesiModel')->create();
        $this->data['sesi'] = Helper::null_checker($result);

        $result = $this->model('JadwalModel')->create();
        $this->data['jadwal'] = Helper::null_checker($result);        
    }

    public function __setSesi()
    {
        if(isset($_SESSION['presensi_adminsession'])){
            $data = [
                'sesi' => $_POST['presensi_sesi'],
                'idJadwal' => $_POST['presensi_jadwal'],
                'waktu_mulai' => $_POST['presensi_waktu_mulai'] ,
                'waktu_selesai' => $_POST['presensi_waktu_selesai']
            ];
            // var_dump($data);die();
            $res = $this->model('SesiModel')->store($data);

            if($res===true){
                Flasher::setFlash('Berhasil membuat sesi',true);
            }else{
                Flasher::setFlash('Gagal membuat sesi',false);
            }
        }
        header('location:'.BASEURL.'admin/sesi');
    }

    public function __setActive()
    {
        if(isset($_SESSION['presensi_adminsession'])){
            $res = $this->model('SesiModel')->update($_POST['presensi_jadwal'],['status'=>2]);
            if($res!==true) echo "gagal";
        }
        header('location:'.BASEURL.'admin');
    }

    public function __setInactive()
    {
        if(isset($_SESSION['presensi_adminsession'])){
            $res = $this->model('SesiModel')->update($_POST['id'],['status'=>3]);
            if($res!==true):
                echo "gagal";
            else:
                echo "berhasil";
            endif;
        }
    }

    public function __setAuto()
    {
        if(isset($_SESSION['presensi_adminsession'])){
            $res = $this->model('SesiModel')->show('byId',$_POST['id']);

            // check last status
            $data = $res['auto_active']=='inactive' ? 'active' : 'inactive';
            $data = ['auto_active'=>$data];

            $res = $this->model('SuperadminModel')->update($_POST['id'],$data);
            if($res!==true){
                echo "isn't switch";
            }
        }
    }

    public function delete()
    {
        if(isset($_SESSION['presensi_adminsession']))
        {
            $condition = ['id'=>$_POST['id']];
            $res = $this->model('SesiModel')->destroy($condition);
            if($res!==true)
            {
                echo "isn't delete jadwal";
            }
        }
    }
}
