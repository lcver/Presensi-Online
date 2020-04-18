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
            public function show($request,$cond=null){
                switch ($request) {
                    case 'byIdTPQ':
                        $result = Database::table('tbpresensi_peserta')
                                                        ->raw('idTpq='.$cond['id'].' and idJadwal='.$cond['idJadwal'])
                                                        ->get();
                        break;
                    case 'filtering' :
                        $result = Database::table('tbpresensi_peserta')
                                                ->raw(
                                                    "nama='".$cond['nama']."'".
                                                    " and jenis_kelamin='".$cond['jenis_kelamin']."'".
                                                    " and idTpq='".$cond['idTpq']."'".
                                                    " and idSesi='".$cond['idSesi']."'")
                                                ->get();
                        break;

                    // case '' :
                    // case '' :
                        // break;
                    
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
                    public function update($id){}
                        /**
                         * 
                         * remove specified resource data
                         */
                        public function destroy($id){}
}
