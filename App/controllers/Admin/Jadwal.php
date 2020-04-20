<?php
namespace Admin;

use App\Core\Controller;
use \Helper as Helper;
use \Flasher as Flasher;

class Jadwal extends Controller
{
    public function index()
    {
        $result = $this->model('JadwalModel')->create();
        $data['jadwal'] = Helper::null_checker($result);

        parent::view('admin/jadwal',$data,'admin');
    }

    public function __setJadwal(Array $data)
    {
        if(isset($_SESSION['presensi_adminsession'])){
            $res = $this->model('JadwalModel')->store($data);
            // var_dump($res);die();
            if($res===true){
                Flasher::setFlash('Jadwal Berhasil Ditambahkan',true);
            }else{
                Flasher::setFlash('Jadwal Gagal Ditambahkan',false);
            }
        }
        header('location:'.BASEURL.'admin/jadwal');
    }

    public function __setActive(String $id)
    {
        if(isset($_SESSION['presensi_adminsession'])){
            $res = $this->model('JadwalModel')->update($id,['status'=>2]);
            // var_dump($_POST);die();
            if($res!==true) echo "gagal";
        }
        header('location:'.BASEURL.'admin/jadwal');
    }

    public function __setInactive(String $id)
    {
        if(isset($_SESSION['presensi_adminsession'])){
            $res = $this->model('JadwalModel')->update($id,['status'=>1]);
            if($res!==true) echo "gagal";
        }
        header('location:'.BASEURL.'admin/jadwal');
    }

    public function delete(String $id)
    {
        if(isset($_SESSION['presensi_adminsession']))
        {
            $res = $this->model('SesiModel')->show('get_by_jadwal',$id);
            if($res!==null)
            {
                $res = $this->model('SesiModel')->destroy(['idJadwal'=>$id]);
                if($res!==true) echo "failed deleting sesi";
            }
            $condition = ['id'=>$id];
            $res = $this->model('JadwalModel')->destroy($condition);
            if($res!==true)
            {
                echo "isn't delete jadwal";
            }
        }
    }
}
