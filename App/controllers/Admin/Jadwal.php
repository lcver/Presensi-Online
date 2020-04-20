<?php
namespace Admin;

use App\Core\Controller;
use \Helper as Helper;
use \Flasher as Flasher;

class Jadwal extends Controller
{
    private $data;

    public function __destruct()
    {
        parent::view('admin/jadwal',$this->data,'admin');
    }

    public function index()
    {
        $result = $this->model('JadwalModel')->create();
        $this->data['jadwal'] = Helper::null_checker($result);
    }

    public function __setJadwal()
    {
        if(isset($_SESSION['presensi_adminsession'])){
            $res = $this->model('JadwalModel')->store(['tanggal'=>$_POST['presensi_tanggal']]);
            // var_dump($res);die();
            if($res===true){
                Flasher::setFlash('Jadwal Berhasil Ditambahkan',true);
            }else{
                Flasher::setFlash('Jadwal Gagal Ditambahkan',false);
            }
        }
        header('location:'.BASEURL.'admin/jadwal');
    }

    public function __setActive()
    {
        if(isset($_SESSION['presensi_adminsession'])){
            $res = $this->model('JadwalModel')->update($_POST['id'],['status'=>2]);
            // var_dump($_POST);die();
            if($res!==true) echo "gagal";
        }
        header('location:'.BASEURL.'admin/jadwal');
    }

    public function __setInactive()
    {
        if(isset($_SESSION['presensi_adminsession'])){
            $res = $this->model('JadwalModel')->update($_POST['id'],['status'=>1]);
            if($res!==true) echo "gagal";
        }
        header('location:'.BASEURL.'admin/jadwal');
    }

    public function delete()
    {
        if(isset($_SESSION['presensi_adminsession']))
        {
            $res = $this->model('SesiModel')->show('get_by_jadwal',$_POST['id']);
            if($res!==null)
            {
                $res = $this->model('SesiModel')->destroy(['idJadwal'=>$_POST['id']]);
                if($res!==true) echo "failed deleting sesi";
            }
            $condition = ['id'=>$_POST['id']];
            $res = $this->model('JadwalModel')->destroy($condition);
            if($res!==true)
            {
                echo "isn't delete jadwal";
            }
        }
    }
}
