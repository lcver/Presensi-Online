<?php

use App\Core\Controller;

class PengurusController extends Controller
{
    public function index()
    {
        $data['subtitlepage'] = "Rekapitulasi Presensi Online Asrama Al-Qur&#039;an PPG Jakarta Pusat";

        /**
         * Search jadwal have status is 2
         */
        $result = $this->model('JadwalModel')->show('get_active_jadwal');
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
                    $data['status_jadwal'][] = $result;
                else:
                    $data['status_jadwal'] = $result;
                endif;
            // var_dump($data['peserta']);
            // die();
        }else{
            $data['status_jadwal'] = null;
            $this->view('dashboard/index',$data,'pengurus');
            return false;
        }
        foreach ($data['status_jadwal'] as $d) {
            $idJadwal = $d['id'];
        }
        
        /**
         * get session when having same idJadwal
         */
        $result = $this->model('SesiModel')->show('get_by_jadwal',$idJadwal);
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
                    $data['status_sesi'][] = $result;
                else:
                    $data['status_sesi'] = $result;
                endif;
            // var_dump($data['peserta']);
            // die();
        }else{
            $data['status_sesi'] = null;
        }
        // $data['status_sesi'] = null;

        // get id sesi
        if(!is_null($data['status_sesi'])){
            foreach ($data['status_sesi'] as $d) {
                $data['status_sesi'] = $d['id'];
            }
        }
        // var_dump($data['status_sesi']);die();

        $dataTPQ = $this->model('TpqModel')->create();

        $resData=[];
        $total=0;
        foreach ($dataTPQ as $d) {
            $condition = [
                'id'=> $d['id'],
                'idJadwal'=> $idJadwal
            ];

            $dataPeserta = $this->model('PesertaModel')->show('byIdTPQ',$condition);
            // var_dump($dataPeserta);die();

            $data['tpq'][] = ['tpq'=>$d['tpq'],'desa'=>$d['desa']];
            if($dataPeserta!==NULL){
                $countData = isset($dataPeserta['nama']) ? 1 : count($dataPeserta);
                // $countData = count($dataPeserta);
                $resData[] = [
                    'idtpq'=> $d['id'],
                    'jumlah'=>$countData
                ];
                $subtotal = $countData;
                $total += $subtotal;
            }else{
                $resData[] = [
                    'idtpq'=> $d['id'],
                    'jumlah'=> 0
                ];
            }
        }
        $data['total'] = $total;
        $data['jumlahdata'] = $resData;
        // var_dump($data['jumlahdata']);
        // die();

        $this->view('dashboard/index',$data,'pengurus');
    }

    public function tpq()
    {
        //get Id
        $id = explode('/',$_GET['url']);
        $id = end($id);

        $res = $this->model('JadwalModel')->show('get_active_jadwal');
        // var_dump($res);


        $result = $this->model('SesiModel')->show('get_by_jadwal',$res['id']);
        // var_dump($result);die();
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
                    $data['status_jadwal'][] = $result;
                else:
                    $data['status_jadwal'] = $result;
                endif;
            // var_dump($data['peserta']);
            // die();
        }else{
            $data['status_jadwal'] = null;
            // $this->view('dashboard/index',$data,'pengurus');
            // return false;
        }
        // $data['status_jadwal'] = null;

        // get id sesi
        foreach ($data['status_jadwal'] as $d) {
            $idJadwal = $d['idJadwal'];
        }
        // var_dump($data['status_jadwal']);die();

        $condition = [
            'id' => $id,
            'idJadwal' => $idJadwal
        ];
        
        $result = $this->model('PesertaModel')->show('byIdTPQ',$condition);
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
                    $data['peserta'][] = $result;
                else:
                    $data['peserta'] = $result;
                endif;
            // var_dump($data['peserta']);
            // die();
        }else{
            $data['peserta']=NULL;
        }


        $result = $this->model('TpqModel')->show($id);
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
                    $data['tpq'] = $result;
                else:
                    $data['tpq'] = $result;
                endif;
            // var_dump($data['tpq']);
            // die();
        }else{
            $data['tpq']=NULL;
        }
        
        $this->view('tpq/index',$data);
    }

    public function jumlah()
    {
        $dataTPQ = $this->model('TpqModel')->create();

        $res = $this->model('JadwalModel')->show('get_active_jadwal');

        $resData=[];
        $total=0;
        foreach ($dataTPQ as $d) {
            $condition = [
                'id'=> $d['id'],
                'idJadwal'=> $res['id']
            ];
            $dataPeserta = $this->model('PesertaModel')->show('byIdTPQ',$condition);

            if($dataPeserta!==NULL){
                $countData = isset($dataPeserta['nama']) ? 1 : count($dataPeserta);
                // $countData = count($dataPeserta);
                $resData[] = $countData;
                $subtotal = $countData;
                $total += $subtotal;
            }else{
                $resData[] = 0;
            }
        }

        // var_dump($resData);
        echo json_encode($resData);
    }
}
