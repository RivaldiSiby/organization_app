<?php

namespace App\Controllers;

use App\Models\LogModel;
use CodeIgniter\RESTful\ResourceController;

class Log extends ResourceController
{
    protected $log;

    public function __construct()
    {
        session();
        $this->log = new LogModel();
    }
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $datalog = [
            'log' => $this->log->getLog()
        ];
        $data = view('log/index', $datalog);
        return $this->respond($data);
    }

    public function clearAll()
    {
        $data = $this->log->getLog();

        // hapus data 
        if (count($data) > 0) {
            foreach ($data as $log) {
                // hapus
                $this->log->delete($log['id_log']);
            }
        }
    }
    public function clearAngkatan()
    {
        $data = $this->log->getLogAngkatan();

        // hapus data 
        if (count($data) > 0) {
            foreach ($data as $log) {
                // hapus
                $this->log->delete($log['id_log']);
            }
        }
    }
    public function clearMonth()
    {
        $data = $this->log->getLogAngkatan();

        // hapus data 
        if (count($data) > 0) {
            // ulangi sebanyak data yang ada
            foreach ($data as $log) {
                $time = explode(' ', $log['created_at']);
                $month = explode('-', $time[0]);
                $date = date('m');
                // hapus
                if (intval($date) == intval($month[1])) {
                    $this->log->delete($log['id_log']);
                }
            }
        }
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        //
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        //
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        //
    }
}
