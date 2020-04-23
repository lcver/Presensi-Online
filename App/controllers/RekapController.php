<?php

use App\Core\Controller;

class RekapController extends Controller
{
    public function index()
    {
        $result = $this->model('TpqModel')->create();
        $tpq = Helper::null_checker($result);

        // var_dump($idTpq);

        $result = $this->model('JadwalModel')->create();
        $jadwal = Helper::null_checker($result);
        
        $count = [];
        foreach ($jadwal as $d) {
            $result = $this->model('PesertaModel')->show('countPeserta_by_jadwal',$d['id']);
            $aggregates = [];

            foreach ($tpq as $dd) {
                $data = $this->model('PesertaModel')->show('countPeserta_by_tpq',['tpq' => $dd['id'],'jadwal' => $d['id']]);
                $aggregates[] = $data['jumlah'];
            }
            
            $min = MIN($aggregates);
            $max = MAX($aggregates);
            $combine = ['min'=>$min,'max'=>$max];
            
            if(!empty($result['total']) )
            {
                $result = array_merge($result,$combine);
                $count[] = $result;
            }
        }
        // var_dump($count);
        // die();

        $data = $count;
        // var_dump($data);
        $this->view('dashboard/rekap',$data);
    }

    public function data($param)
    {
        $id = ['id'=>$param];
        $result = $this->model('JadwalModel')->show('get_by_id',$id);
        $jadwal = Helper::null_checker($result);
        foreach ($jadwal as $d) {
            $jadwal = $d['id'];
        }
        
        $result = $this->model('TpqModel')->create();
        $tpq = Helper::null_checker($result);

        $total=0;
        foreach ($tpq as $d) {
            $condition = [
                'id'=> $d['id'],
                'idJadwal'=>$jadwal
            ];

            $data['tpq'][] = ['tpq'=>$d['tpq'],'desa'=>$d['desa']];

            $dataPeserta = $this->model('PesertaModel')->show('get_by_id_tpq_jadwal',$condition);
            
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

        // die();
        $data['total'] = $total;
        $data['jumlahdata'] = $resData;

        
        $this->view('dashboard/rekap_data', $data);
        // var_dump($result);
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
            $dataPeserta = $this->model('PesertaModel')->show('get_by_id_tpq_jadwal',$condition);

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
