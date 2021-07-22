<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$data = array(
            'status' => 'OK',
            'message' => 'Welcome',
        );
        echo json_encode($data);
	}
}
