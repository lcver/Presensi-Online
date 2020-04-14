<?php

/**
 * 
 * 
 * call controller
 */
use App\Core\Controller;

class PesertaModel extends Controller
{
    /**
     * 
     * create view resource data
     */
    public function create(){}
        /**
         * 
         * stored new resourece data
         */
        public function store(array $data){
            return Database::table('tbpresensi_peserta')->insert($data);
        }
            /**
             * 
             * display the specified resource data
             */
            public function show($request){
                return Database::table('tbpresensi_peserta')
                                                ->where('idTpq',$request)
                                                // ->join('tbpresensi_tpq')
                                                // ->on('tbpresensi_tpq.id',"tbpresensi_peserta.idTpq and tbpresensi_peserta.idTpq =".$request)
                                                ->get();
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
                    public function update($id){}
                        /**
                         * 
                         * remove specified resource data
                         */
                        public function destroy($id){}
}
