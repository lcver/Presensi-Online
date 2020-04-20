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
        echo $param;
    }
}
