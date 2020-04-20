<?php
use App\Core\Controller;

class AdminController extends Controller
{
    public function __construct()
    {
        if(!isset($_SESSION['presensi_adminsession'])){
            header('location:'.BASEURL.'auth');
            return FALSE;
        }
        require 'Admin/Jadwal.php';
        // $jadwal = new \Admin\Jadwal;

        require 'Admin/Sesi.php';
        // $sesi = new \Admin\Sesi;
    }

    public function index()
    {        
        /**
         * Tampil semua sesi
         */
        $result = $this->model('SesiModel')->create();
        $data['sesi'] = Helper::null_checker($result);

        /**
         * Tampil sesi belum aktif
         */
        $result = $this->model('SesiModel')->show('set_active');
        $data['set_sesi'] = Helper::null_checker($result);

        /**
         * Tampil Data Admin
         */
        $result = $this->model('SuperadminModel')->show();
        $data['dataadmin'] = Helper::null_checker($result);

        // get id Jadwal
        $res = $this->model('JadwalModel')->show('get_active_jadwal');
        // var_dump($res);die();

        /**
         * Show session ready to activated
         */
        $result = $this->model('SesiModel')->show('get_active');
        $data['activated'] = Helper::null_checker($result);


        $this->view('admin/index',$data,'admin');
    }

    /**
     * Jadwal Page
     * ----------------------------------------------------------
     */
    public function jadwal()
    {
        $jadwal = new \Admin\Jadwal;
        $jadwal->index();
        return $jadwal;
    }

    public function set_jadwal()
    {
        $jadwal = $this->jadwal();
        $jadwal->__setJadwal();
    }

    public function activated_jadwal()
    {
        $jadwal = $this->jadwal();
        $jadwal->__setActive();
    }

    public function inactive_jadwal()
    {
        $jadwal = $this->jadwal();
        $jadwal->__setInactive();
    }

    public function delete_jadwal()
    {
        $jadwal = $this->jadwal();
        $jadwal->delete();
    }

    /**
     * Sesi Page
     * ----------------------------------------------------------
     */
    public function sesi()
    {
        $sesi = new \Admin\Sesi;
        $sesi->index();
        return $sesi;
    }

    public function set_sesi()
    {
        $sesi = $this->sesi();
        $sesi->__setSesi();
    }

    public function activated_sesi()
    {
        $sesi = $this->sesi();
        $sesi->__setActive();
    }

    public function inactive_sesi()
    {
        $sesi = $this->sesi();
        $sesi->__setInactive();
    }

    public function auto_sesi()
    {
        $sesi = $this->sesi();
        $sesi->__setAuto();
    }

    public function delete_sesi()
    {
        $sesi = $this->sesi();
        $sesi->delete();
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
}
