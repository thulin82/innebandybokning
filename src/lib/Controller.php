<?php
class Controller 
{

    /**
     * Model
     *
     * @param string $model Model
     *
     * @return mixed Model
     */
    public function model(string $model)
    {
        include_once '../src/models/' . $model . '.php';
        return new $model();
    }

    /**
     * View
     *
     * @param string $view View
     * @param array  $data Data
     *
     * @return void
     */
    public function view(string $view, array $data = [])
    {
        if (file_exists('../src/views/' . $view . '.php')) {
            include_once '../src/views/' . $view . '.php';
        } else {
            die('View (' . $view . ') does not exist');
        }
    }
}
