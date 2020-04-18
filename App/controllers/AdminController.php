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
        
        /**
         * Tampil semua sesi
         */
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
                    $data['sesi'][] = $result;
                else:
                    $data['sesi'] = $result;
                endif;
            // var_dump($data['sesi']);
            // die();
        }else{
            $data['sesi']=NULL;
        }

        /**
         * Tampil sesi belum aktif
         */
        $result = $this->model('SesiModel')->show('set_active');
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
                    $data['set_sesi'][] = $result;
                else:
                    $data['set_sesi'] = $result;
                endif;
            // var_dump($data['set_sesi']);
            // die();
        }else{
            $data['set_sesi']=NULL;
        }

        /**
         * Tampil Data Admin
         */
        $result = $this->model('SuperadminModel')->show();
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
                    $data['dataadmin'][] = $result;
                else:
                    $data['dataadmin'] = $result;
                endif;
            // var_dump($data['dataadmin']);
            // die();
        }else{
            $data['dataadmin']=NULL;
        }

        // get id Jadwal
        $res = $this->model('JadwalModel')->show('get_active_jadwal');

        /**
         * Show session ready to activated
         */
        $result = $this->model('SesiModel')->show('get_active');
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
                    $data['activated'][] = $result;
                else:
                    $data['activated'] = $result;
                endif;
            // var_dump($data['activated']);
            // die();
        }else{
            $data['activated']=NULL;
        }


        $this->view('admin/index',$data,'admin');
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
                    $data['sesi'][] = $result;
                else:
                    $data['sesi'] = $result;
                endif;
            // var_dump($data['sesi']);
            // die();
        }else{
            $data['sesi']=NULL;
        }

        $result = $this->model('JadwalModel')->create();
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
                    $data['jadwal'][] = $result;
                else:
                    $data['jadwal'] = $result;
                endif;
            // var_dump($data['jadwal']);
            // die();
        }else{
            $data['jadwal']=NULL;
        }
        

        $this->view('admin/jadwal',$data,'admin');
    }

    public function jadwal_detail()
    {
        $this->view('admin/jadwal_detail',[],'admin');
    }

    public function set_jadwal()
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

    public function set_sesi()
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
        header('location:'.BASEURL.'admin/jadwal');
    }
    public function activated_sesi()
    {
        if(isset($_SESSION['presensi_adminsession'])){
            $res = $this->model('SesiModel')->update($_POST['presensi_jadwal'],['status'=>2]);
            if($res!==true) echo "gagal";
        }
        header('location:'.BASEURL.'admin');
    }

    public function inactive_sesi()
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

    public function activated_jadwal()
    {
        if(isset($_SESSION['presensi_adminsession'])){
            $res = $this->model('JadwalModel')->update($_POST['id'],['status'=>2]);
            // var_dump($_POST);die();
            if($res!==true) echo "gagal";
        }
        header('location:'.BASEURL.'admin/jadwal');
    }

    public function inactive_jadwal()
    {
        if(isset($_SESSION['presensi_adminsession'])){
            $res = $this->model('JadwalModel')->update($_POST['id'],['status'=>1]);
            if($res!==true) echo "gagal";
        }
        header('location:'.BASEURL.'admin/jadwal');
    }

    /**
     * auto update jadwal
     */
    public function auto_sesi()
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

    public function delete_jadwal()
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

    public function delete_sesi()
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

    public function countdown_jadwal()
    {
        // mengatur time zone untuk WIB.
        date_default_timezone_set("Asia/Jakarta");

        $res = $this->model('SesiModel')->create();

        // var_dump($res);

        $dateNow = mktime(date("H"), date("i"), date("s"),date("d"), date("m"), date("y"));
        foreach ($res as $d) {
            // date
            $day = self::dateCreateFormat($d['tanggal'],'d');
            $month = self::dateCreateFormat($d['tanggal'],'m');
            $year = self::dateCreateFormat($d['tanggal'],'y');

            // time start
            $hour_start = self::dateCreateFormat($d['waktu_mulai'],'H');
            $min_start = self::dateCreateFormat($d['waktu_mulai'],'i');
            $sec_start = self::dateCreateFormat($d['waktu_mulai'],'s');

            // time end
            $hour_end = self::dateCreateFormat($d['waktu_selesai'],'H');
            $min_end = self::dateCreateFormat($d['waktu_selesai'],'i');
            $sec_end = self::dateCreateFormat($d['waktu_selesai'],'s');

            $dateSesiStart = mktime($hour_start,$min_start,$sec_start,$day,$month,$year);
            $dateSesiEnd = mktime($hour_end,$min_end,$sec_end,$day,$month,$year);

            $setTimer = self::timer_zone($dateSesiStart,$dateNow);
            $time = $setTimer['day']+$setTimer['hour']+$setTimer['minute']+$setTimer['sec'];
            if($time < 0){
                echo "Sudah Terlewat </br>";
            }else{
                echo "Akan Berlangsung </br>";
            }

            // echo "Sesi Akan dimulai dalam :".$setTimer['day'].' hari '.$setTimer['hour'].':'.$setTimer['minute'].':'.$setTimer['sec'] ;

        }
        
        // mencari mktime untuk current time
        // $selisih2 = mktime(date("H"), date("i"), date("s"), date("d"), date("m"), date("Y"));
    }

    public function dateCreateFormat($date,$format)
    {
        $date = date_create($date);
        return date_format($date,$format);
    }

    public function timer_zone($start,$now)
    {
        // different second from date sesi to date now
        $secDiff = $start - $now;

        // day
        $date['day'] = floor($secDiff / 86400);

        // hour
        $left = $secDiff % 86400;
        $date['hour'] = floor($left / 3600);

        // minute
        $left = $left % 3600;
        $date['minute'] = floor($left/60);

        $left = $left % 60;
        $date['sec'] = floor($left/1);
        return $date;
    }

    public function auth()
    {
        if(!isset($_SESSION['presensi_adminsession'])){
            $this->view('authentication/index',[],'self');
            if(isset($_SESSION['presensi_wrong'])){
                unset($_SESSION['presensi_wrong']);
            }
        }else{
            echo $_SESSION['presensi_adminsession'];
        }
    }

    public function auth_entry_password()
    {
        // $pass = "presensionlineasramappgjakartapusatadminlogin";
        $res = $this->model('SuperadminModel')->auth($_POST['presensi_password']);
        // var_dump($res);die();
        if(is_null($res)){
            $_SESSION['presensi_wrong'] = true;
        }else{
            $_SESSION['presensi_adminsession'] = $res['id'];
            $_SESSION['presensi_adminnama'] = $res['nama'];
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
