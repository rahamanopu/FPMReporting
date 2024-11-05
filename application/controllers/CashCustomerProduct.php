<?php
defined('BASEPATH') or exit('No direct script access allowed');


class CashCustomerProduct extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function importCashPrice()
	{
		if(!empty($_POST)) {

			$period = $this->input->post('period'); 
			$period = date('Ym',strtotime($period));
			$fileName = 'cash_price_file';
			$cash_price = $this->importDataFromExcelFile($fileName);
			$CI = & get_instance();
			$CI->db = $this->load->database('cbsdms',true);

			$userId= $this->session->userdata('userid');
			$date = date('Y-m-d h:i:s');

			$count = 0;
			if(!empty($cash_price['excel_data'])) {
				$dataToAdd = [];
				try{
					foreach($cash_price['excel_data'] as $item) {
						// echo '<pre>',print_r($item);die();
						$dataToAdd['Period'] = $period;
						$dataToAdd['ProductCode'] = $item[0];
						$dataToAdd['UnitPrice'] = $item[3];
						$dataToAdd['VAT'] = $item[4];
						$dataToAdd['EntryBy'] = $userId;
						$dataToAdd['EntryDate'] = $date;
	
						// check already added or not
						if(empty($this->getCashProductPrice($period,$dataToAdd['ProductCode']))) {
							// insert
							$status = $this->db->insert('CashCustomerProductPrice',$dataToAdd);
							$count++;
						} else {
							// update
							$condition = [
								'Period' => $period,
								'ProductCode' => $dataToAdd['ProductCode']
							];
							unset($dataToAdd['EntryBy']);
							unset($dataToAdd['EntryDate']);
	
							$dataToAdd['EditBy'] = $userId;
							$dataToAdd['EditDate'] = $date;
							$status = $this->db->update('CashCustomerProductPrice',$dataToAdd,$condition);
							$count++;
						}
					}
					if($status) {
						setFlashMsg($count . " Record Added Successfully");
					}

				}catch(\Exception $ex) {
					setFlashMsg("Exception happend","error");
				}
			}
			
		}
		$data['pageTitel'] = "Product Cash Price";
		$data['action'] = "cash-cutomer-price-add";
		$this->loadView('cash_customer/cash_customer_product_price',$data);
	}

	private function getCashProductPrice($period,$productCode) {
		$sql = "select * from CashCustomerProductPrice	where Period='$period' and ProductCode='$productCode'";
		$query = $this->db->query($sql);
		if($query && !empty($result = $query->result_array())) {
			return $result[0];			
		}
		return [];

	}

	private function importDataFromExcelFile($fileName)
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = '*';
        $config['max_size'] = 100000;
        $this->load->library('upload', $config);

        if ($_FILES[$fileName]['type'] == 'application/vnd.ms-excel' ||
            $_FILES[$fileName]['type'] == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') {
            $data = [];
            if (!$this->upload->do_upload($fileName)) {
                $data['file_error_message'] = $this->upload->display_errors();
            } else {				
                $data['fileinfo'] = array('upload_data' => $this->upload->data());
                $file_path = 'uploads/' . $data['fileinfo']['upload_data']['file_name'];
                //load the excel library
                $this->load->library('Excel');
                //read file from path
                $objPHPExcel = PHPExcel_IOFactory::load($file_path);
                //get only the Cell Collection
                $highestColumm = $objPHPExcel->setActiveSheetIndex(0)->getHighestColumn(); // e.g. "EL"
                $highestRow = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();

                $highestColumm++;
                for ($row = 2; $row < $highestRow + 1; $row++) {
                    $dataset = array();
                    for ($column = 'A'; $column != $highestColumm; $column++) {
						$dataset[] = $objPHPExcel->setActiveSheetIndex(0)->getCell($column . $row)->getValue();                        
                        
                    }
                    $cells[] = $dataset;
                }
                $data['excel_data'] = $cells;
                unlink($file_path);
            }
        } else {
            $data['file_error_message'] =  "Invalid file format!";
        }
        return $data;
    }
}