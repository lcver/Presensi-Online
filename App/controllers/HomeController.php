<?php

use App\Core\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $result = $this->model('SesiModel')->show('get_active');
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
                    $data['sesi'][] = $result;
                else:
                    $data['sesi'] = $result;
                endif;
            // var_dump($data['sesi']);
            // die();
        }else{
            $data['sesi']=NULL;
        }

        
        // $this->view('load/index',[],'self');
        $data['tpq'] = $this->model('TpqModel')->create();
        $this->view('home/index',$data,'peserta');
    }

    public function submitData()
    {
        $postData = [
            'nama'=>$_POST['presensi_nama'],
            'jenis_kelamin'=>$_POST['presensi_jeniskelamin'],
            'idTpq'=>$_POST['presensi_tpq'],
            'idSesi'=>$_POST['presensi_sesi']
        ];

        $res = $this->model('PesertaModel')->store($postData);
        if($res===true)
        {
            Flasher::setFlash("Berhasil",true);
        }else{
            Flasher::setFlash('Gagal',false);
        }
        header('location:'.BASEURL);
    }   
}
