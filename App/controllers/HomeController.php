<?php

use App\Core\Controller;

class HomeController extends Controller
{
    public function index()
    {
        // $this->view('load/index',[],'self');
        $data = $this->model('TpqModel')->create();
        $this->view('home/index',$data,'peserta');
    }

    public function submitData()
    {
        $postData = [
            'nama'=>$_POST['presensi_nama'],
            'jenis_kelamin'=>$_POST['presensi_jeniskelamin'],
            'idTpq'=>$_POST['presensi_tpq']
        ];

        $res = $this->model('PesertaModel')->store($postData);
        if($res===true)
        {
            Flasher::setFlash('Berhasil : '.$_POST['presensi_nama'],true);
        }else{
            Flasher::setFlash('Gagal',false);
        }
        header('location:'.BASEURL);
    }
    
}
