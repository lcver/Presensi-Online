<?php

class Helper
{
    public function null_checker(array $request)
    {
        if(!is_null($request)){
            $arr_key = array_keys($request);

            $count = count($arr_key);
            $num = NULL;

            for ($i=0; $i < $count ; $i++) { 
                if(is_numeric($arr_key[$i])) $num = true;
            }
                // if(!$num):
                //     $response[] = $request;
                // else:
                //     $response = $request;
                // endif;
                $response = !$num ? [$request] : $request;

        }else{
            $response = null;
        }
        return $response;
    }
}
