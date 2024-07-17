<?php
class Crud extends CI_Controller
{
    public function index()
    {
        // echo 'Crud - index';
        $data['allRecords'] = $this->modCrud->getAllRecords();
        $this->load->view('home', $data);
    }
    public function addUser()
    {
        if (!$this->input->is_ajax_request()) {
            $this->session->set_flashdata('error', 'Please call the AJAX request!');
            redirect('crud');
        } else {
            $data['stName'] = $this->input->post('name', TRUE);
            $data['stEmail'] = $this->input->post('email', TRUE);
            $data['stPassword'] = $this->input->post('password', TRUE);
            $data['stDate'] = date('Y-m-d H:i:s');

            // var_dump($data);

            $result = $this->modCrud->addNewUser($data);

            if (is_integer($result)) {
                $lastRecord = $this->modCrud->getLastRecord($result);
                if (count($lastRecord) === 1) {
                    echo json_encode($lastRecord);
                } else {
                    echo 'Does not work!';
                }
            } else {
                echo "Failed to add student!";
            }
        }
    }
    public function checkUser()
    {
        if (!$this->input->is_ajax_request()) {
            echo 'redirect here';
        } else {
            $data['stId'] = $this->input->post('text', true);
            $data['stId'] = $this->encryption->decrypt($data['stId']);
            $checkResult = $this->modCrud->checkUser($data);

            if (count($checkResult) === 1) {
                echo json_encode($checkResult);
            } else {
                echo 'not working';
            }
        }
    }
    public function updateUser()
    {
        if (!$this->input->is_ajax_request()) {
            echo 'redirect here';
        } else {
            $data['stName'] = $this->input->post('dyName', true);
            $data['stEmail'] = $this->input->post('dyEmail', true);
            $data['stPassword'] = $this->input->post('dyPassword', true);
            $data['stId'] = $this->input->post('dyId', true);

            if (
                empty($data['stName']) || empty($data['stEmail']) ||
                empty($data['stPassword']) || empty($data['stId'])
            ) {
                echo 'All the fields are required!';
            } else {
                $updateResult = $this->modCrud->updateUser($data);
                if ($updateResult) {
                    echo "updated";
                } else {
                    echo "not updated";
                }
            }
        }
    }
}
