<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Review extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->helper(array('form', 'url'));
		$this->load->model('booster');
		$this->load->library('form_validation');

		$data['fundraisers'] = $this->booster->get_fundraisers(false);

		// set validation rules
		$this->form_validation->set_rules('email','Email address', 'required|valid_email');
		$this->form_validation->set_rules('name','Name', 'required');
		$this->form_validation->set_rules('starz','Rating', 'callback_starzrating');
		$this->form_validation->set_rules('fundraiser','fundraiser', 'required');


		if ($this->form_validation->run() == FALSE)	// haven't submitted yet.
		{
			$this->load->view('templates/page_header');
			$this->load->view('view_review',$data);
			$this->load->view('templates/page_footer');
		}
		else
		{
			$error_flag = 0;
			$msg = null;
			$info = $this->input->post(NULL, TRUE);	//retrieve the entire post array

			$usingother = 0;

			if (isset($info['other']) && ($info['other'] != '' || $info['other'] !=  NULL)) {
				$usingother = 1;
				$info['fundraiser'] = $this->booster->add_fundraiser($info);
			}

			if ($result = $this->booster->checkexistingEmail($info['email'], $info['fundraiser']) === true) {
				$error_flag = 1;
				$msg = '<p class="text-danger">You have already reviewed this fundraiser.</p>';
			} else if ( $result = $this->booster->checkexistingName($info['name'], $info['fundraiser']) === true) {
				$error_flag = 1;
				$msg = '<p class="text-danger">You have already reviewed this fundraiser.</p>';
			}

			if ($error_flag != 1) {
				$this->booster->add_fundraisers_review($info);
				$results = $this->booster->getFundraiserName($info['fundraiser']);
				$msg = "<h4 class=\"text-success\">Thank you for reviewing ".trim($results[0]['FundraiserName'])."'s Fundraiser</h4>";
			}

			$data['fundraisers'] = $this->booster->get_fundraisers();
			$data['msg'] = $msg;
			$this->load->view('templates/page_header');
			$this->load->view('view_process', $data);
			$this->load->view('templates/page_footer');

		}
	}
	public function starzrating($input) {
		if ($input == null) {
			$this->form_validation->set_message('starzrating',
				'Please rate this fundraiser by selecting the number of stars (the more the better).');
			return  FALSE;
		} else {
			return TRUE;
		}
	}

}

function dd($input) {
	echo "<pre>".print_r($input, true)."</pre>";
	die();
}
function debug($input) {
	echo "<pre>".print_r($input, true)."</pre><br /><br /><br />";
}
