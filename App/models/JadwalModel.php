<?php

/**
 * 
 * 
 * call controller
 */
use App\Core\Controller;

class JadwalModel extends Controller
{
    /**
     * 
     * create view resource data
     */
    public function create(){
        return Database::table('tbpresensi_jadwal')
                                    ->orderBy('tanggal','asc')
                                    ->get();
    }
        /**
         * 
         * stored new resourece data
         */
        public function store($request){
            return Database::table('tbpresensi_jadwal')->insert($request);
        }
            /**
             * 
             * display the specified resource data
             */
            public function show($request,$cond=null){
                switch ($request) {
                    case 'get_last_id':
                        $result = Database::table('tbpresensi_jadwal')
                                                        ->orderBy('id','desc limit 1')
                                                        ->fetch(['id'])
                                                        ->get();
                        break;
                    
                    case 'get_active_jadwal':
                        $result = Database::table('tbpresensi_jadwal')
                                                        ->where('status',2)
                                                        ->get();
                        break;
                    default:
                        # code...
                        break;
                }
                return $result;
            }
                /**
                 * 
                 * display form for editing resource data
                 */
                public function edit($id){}
                    /**
                     * 
                     * update the specified resource data
                     */
                    public function update($id,$request){
                        return Database::table('tbpresensi_jadwal')
                                                    ->where('id',$id)
                                                    ->update($request);
                    }
                        /**
                         * 
                         * remove specified resource data
                         */
                        public function destroy($id){
                            return Database::table('tbpresensi_jadwal')->delete($id);
                        }
}
