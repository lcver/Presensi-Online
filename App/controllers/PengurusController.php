<?php

use App\Core\Controller;

class PengurusController extends Controller
{
    public function index()
    {
        $data['subtitlepage'] = "Prepensi Online Asrama Al-quran PPG Jakarta Pusat";
        $dataTPQ = $this->model('TpqModel')->create();
        $resData=[];
        $total=0;
        foreach ($dataTPQ as $d) {
            $dataPeserta = $this->model('PesertaModel')->show('byIdTPQ',$d['id']);
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
        
        $result = $this->model('PesertaModel')->show('byIdTPQ',$id);
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
        $resData=[];
        foreach ($dataTPQ as $d) {
            $dataPeserta = $this->model('PesertaModel')->show($d['id']);
            $data['tpq'][] = ['tpq'=>$d['tpq'],'desa'=>$d['desa']];
            if($dataPeserta!==NULL){
                $countData = isset($dataPeserta['nama']) ? 1 : count($dataPeserta);
                $resData[] = $countData;
            }else{
                $resData[] = 0;
            }
        }
        // var_dump($resData);
        echo json_encode($resData);
    }
}
