<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Portal extends REST_Controller
{
    public $tables;

    public function __construct()
    {
        parent::__construct();
        // Add your table here
        $this->tables = ['customer'];
    }

    public function index_get()
    {
        $tables = $this->tables;
        $table  = $this->get('table');
        if (in_array($table, $tables)) {
            $id    = $this->get('id');
            $users = $this->data->gets($table);

            if ($id === null) {
                if ($users) {
                    $this->response($users, REST_Controller::HTTP_OK);
                } else {
                    $this->response([
                        'status'  => false,
                        'message' => 'No data were found',
                    ], REST_Controller::HTTP_NOT_FOUND);
                }
            } else {
                $id = (int) $id;

                if ($id <= 0) {
                    $this->response(null, REST_Controller::HTTP_BAD_REQUEST);
                }

                $user = $this->data->get($table, $id);
                if (!is_null($user)) {
                    $this->set_response($user, REST_Controller::HTTP_OK);
                } else {
                    $this->set_response([
                        'status'  => false,
                        'message' => 'Data could not be found',
                    ], REST_Controller::HTTP_NOT_FOUND);
                }
            }
        } else {
            $this->set_response([
                'status'  => false,
                'message' => "Table $table could not be found",
            ], REST_Controller::HTTP_NOT_FOUND);
        }

    }

    public function index_post()
    {
        $tables = $this->tables;
        $table  = $this->get('table');
        if (in_array($table, $tables)) {
            $data                 = $this->post();
            $data['date_created'] = date('Y-m-d H:i:s');
            $data['date_updated'] = date('Y-m-d H:i:s');
            $set                  = $this->data->set($table, $data);
            if ($set) {
                $this->set_response([
                    'status'  => true,
                    'message' => 'Data has been successfully created',
                ], REST_Controller::HTTP_CREATED);
            } else {
                $this->response(null, REST_Controller::HTTP_BAD_REQUEST);
            }
        } else {
            $this->set_response([
                'status'  => false,
                'message' => "Table $table could not be found",
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function index_put()
    {
        $tables = $this->tables;
        $table  = $this->get('table');
        if (in_array($table, $tables)) {
            $id                   = (int) $this->get('id');
            $data                 = $this->put();
            $data['date_updated'] = date('Y-m-d H:i:s');
            $check                = $this->data->get($table, "WHERE id = $id");
            if (!is_null($check)) {
                $data_update = $this->data->update($table, $data, $id);
                if ($data_update) {
                    $this->set_response([
                        'status'  => true,
                        'message' => ucfirst($table) . ' has been successfully updated',
                    ], REST_Controller::HTTP_OK);
                } else {
                    $this->response(null, REST_Controller::HTTP_BAD_REQUEST);
                }
            } else {
                $this->set_response([
                    'status'  => false,
                    'message' => 'Data could not be found',
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        } else {
            $this->set_response([
                'status'  => false,
                'message' => "Table $table could not be found",
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function index_delete()
    {
        $tables = $this->tables;
        $table  = $this->get('table');
        if (in_array($table, $tables)) {
            $id = (int) $this->get('id');
            if ($id <= 0) {
                $this->set_response([
                    'status'  => false,
                    'message' => 'id parameter is wrong',
                ], REST_Controller::HTTP_BAD_REQUEST);
            } else {
                $check = $this->data->get($table, "WHERE id = $id");
                if (!is_null($check)) {
                    $delete_data = $this->data->delete($table, $id);
                    if ($delete_data) {
                        $message = [
                            'status'  => true,
                            'id'      => $id,
                            'message' => ucfirst($table) . ' has been successfully deleted',
                        ];
                        $this->set_response($message, REST_Controller::HTTP_OK);
                    } else {
                        $this->set_response([
                            'status'  => false,
                            'message' => 'Failed delete data',
                        ], REST_Controller::HTTP_BAD_REQUEST);
                    }
                } else {
                    $this->set_response([
                        'status'  => false,
                        'message' => 'Data could not be found',
                    ], REST_Controller::HTTP_NOT_FOUND);
                }
            }
        } else {
            $this->set_response([
                'status'  => false,
                'message' => "Table $table could not be found",
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

}
