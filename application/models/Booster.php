<?php
/**
 * Created by PhpStorm.
 * User: stuart
 * Date: 4/26/18
 * Time: 9:08 AM
 */
class Booster extends CI_Model {

	public function __construct()
	{
		$this->load->database();
		$this->load->helper(array('form', 'url'));
	}

	/**
	 * get list of fundraisers
	 */
	public function get_fundraisers($ordered = true) {
		if ($ordered==true)
			$txt_ordered= " order by reviews desc, FundraiserName asc";
		else
			$txt_ordered =" order by FundraiserName asc;";


		$sql = @"select f.idFundraiser, f.FundraiserName, AVG(r.ReviewStars) as reviews 
				from Fundraiser f left join Reviews r on f.idFundraiser=r.idFundraiser
                group by FundraiserName ".
			   $txt_ordered;
		$fundraiserList = $this->db->query($sql);
		return $fundraiserList->result_array();
	}
	public function getFundraiserName($id) {
		$fnName = $this->db->select('FundraiserName')->from('Fundraiser')
			->where('idFundraiser',$id)->limit(1)->get();
		return ($fnName->result_array());
	}

	public function add_fundraisers_review($review_arr) {
		if (!is_array($review_arr )) {
			return "Invalid. Invalid";
		}
		$reviews = array(
			'idFundraiser' => $review_arr['fundraiser'],
			'ReviewStars'  => $review_arr['starz'],
			'txtReviews'   => $review_arr['review'],
			'ReviewerName'  => $review_arr['name'],
			'ReviewerEmail'=> $review_arr['email'],
			'ReviewDate'   => date('Y-m-d H:i:s')
		);

		$this->db->insert('Reviews',$reviews);
	}

	public function add_fundraiser($review_arr) {
		if (isset($review_arr['other']) && ($review_arr['other'] != '' || $review_arr['other'] !=  NULL)) {
				$this->db->insert('Fundraiser', array('FundraiserName'=>$review_arr['other']));
				$query = $this->db->query('select `idFundraiser` from Fundraiser where FundraiserName like "%'.$review_arr['other'].'%"');
				foreach ($query->result_array() as $row) {
					$id = $row['idFundraiser'];
				}
				return $id;
		}
	}

	public function checkexistingName($string, $fundraiser) {
		$query = $this->db->select('ReviewerName')->
			where('ReviewerName',$string)->
			where('idFundraiser',$fundraiser)->
			from('Reviews')->get();

		if ($query->num_rows() > 0)
			return true;
		else
			return false;
	}
	public function checkexistingEmail($email, $fundraiser) {
		$query = $this->db->select('ReviewerEmail')->
			where('ReviewerEmail',$email)->
			where('idFundraiser',$fundraiser)->
			from('Reviews')->get();
		if ($query->num_rows() > 0)
			return true;
		else
			return false;
	}
}
