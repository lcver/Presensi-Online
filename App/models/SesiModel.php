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
                                    ->orderBy('sesi','asc')
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
            public function show(){}
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
