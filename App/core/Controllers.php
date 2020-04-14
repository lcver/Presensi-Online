<?php

namespace App\Core;
/**
 * 
 * 
 */
class Controller
{
    public function view($view, $data=[], $category="")
    {
        /**
         * 
         * Set Template
         */
        if($category==="self")
        {
            $template=[$view];
        }else{
            $template = [
                'Template/header',
                'Template/navbar',
                'Template/sidebar',
                'Template/contentHeader',
                $view,
                'Template/contentFooter',
                'Template/footer'
            ];
        }
        $count = count($template);

        /**
         * 
         * running page
         */
        $i=0;
        while ($i < $count) {
            require_once '../App/views/'.$template[$i].'.php';
            $i++;}
    }

    public function model($model)
    {
        require_once '../App/models/' . $model . '.php';
        return new $model;
    }
}
