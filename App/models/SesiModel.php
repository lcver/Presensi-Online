<?php

/**
 * 
 * 
 * call controller
 */
use App\Core\Controller;

class SesiModel extends Controller
{
    /**
     * 
     * create view resource data
     */
    public function create(){
        return Database::table('tbpresensi_sesi')
                                    ->orderBy('tanggal asc, waktu_mulai','asc')
                                    ->get();
    }
        /**
         * 
         * stored new resourece data
         */
        public function store(array $request){
            return Database::table('tbpresensi_sesi')->insert($request);
        }
            /**
             * 
             * display the specified resource data
             */
            public function show($request,$data=null){
                switch ($request) {
                    case 'get_active':
                        $result = Database::table('tbpresensi_sesi')
                                                        ->where('status',2)
                                                        ->orderBy('tanggal asc, waktu_mulai','asc')
                                                        ->get();
                        break;
                    case 'set_active':
                        $result = Database::table('tbpresensi_sesi')
                                                        ->where('status',1)
                                                        ->orderBy('tanggal asc, waktu_mulai','asc')
                                                        ->get();
                        break;
                    case 'byId':
                        $result = Database::table('tbpresensi_sesi')
                                                        ->where('id',$data)
                                                        ->orderBy('tanggal asc, waktu_mulai','asc')
                                                        ->get();
                        break;
                    
                    default:
                        $result = [];
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
                    public function update($id, $request){
                        return Database::table('tbpresensi_sesi')
                                                    ->where('id',$id)
                                                    ->update($request);
                    }
                        /**
                         * 
                         * remove specified resource data
                         */
                        public function destroy($id){
                            return Database::table('tbpresensi_sesi')
                                                    ->delete($id);
                        }
}
