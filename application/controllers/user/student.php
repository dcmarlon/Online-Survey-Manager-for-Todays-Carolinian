<?php

    class Student extends Admin_Controller{
        
        function __construct ()
	{
		parent::__construct();
                  
                $this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('html');
                $this->load->model('student_m');
	}
        
       public function index ()
	{   
                // Load our view to be displayed
               // to the user
               $data['msg'] = $msg;
		$this->load->view('admin/survey/user/login',$data);
	}
        
         public function process(){
            // Load the model
            $this->load->model('login_model');
            // Validate the user can login
            $result = $this->login_model->validate();
            // Now we verify the result
            if(! $result){
                // If user did not validate, then show them login page again
                $msg = '<font color=red>Invalid username and/or password.</font><br />';
                $this->index($msg);
            }else{
                // If user did validate, 
                // Send them to members area
                redirect('admin/survey/user/home');
            }         
       }
        
        public function login ()
        {
        // redirect if already logged in
        if ($this->ion_auth->logged_in() == TRUE) {
            redirect('take survey');
        }
        
        // Validate the form
        $this->form_validation->set_rules($this->student_m->validation);
        if ($this->form_validation->run() == true) {
            
            // Try to log in
            if ($this->ion_auth->login($this->input->post('student_id')) == TRUE) {
                redirect('questions/listing');
            }
            else {
                $this->data['error'] = 'We could not log you in';
            }
        }
        
             // Set subview & Load layout
             $this->load_view('users/login');
        }

    }