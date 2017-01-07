<?php
class Pages extends CI_Controller
 { 
        public function __construct()
        {
                parent::__construct();
                $this->load->library('form_validation');
                $this->load->model('books_models');
                $this->load->helper('url_helper');
        }
        
        public function login()
         {
            $this->load->view('pages/customer');
         }

        public function enter()
         {
            $this->load->view('pages/about'); 
         }

       public function search_page()
         {
            $this->load->view('pages/Search');
         }

       public function registerPage()
         {
            $this->load->view('pages/register');
         }

       public function login_validation()
          {
                 $session_data = array('shoppingbasket'=>NULL);
                 $_SESSION['shoppingbasketFin']=array();
                 $this->session->set_userdata($session_data);
                  $submitForm = $this->input->post('submit');
                  if($submitForm == 'Login'){

                  $username = $this->input->post('username');
                  $password = $this->input->post('password');
                  $password = md5($password);
                  $this->load->model('books_models');
                  if($this->books_models->can_login($username,$password))
                  {

                    $session_data = array('username'=>$username);
                    $this->session->set_userdata($session_data);
                    redirect(base_url() . 'Pages/search_page');
                  }
                  else
                  {
                   $this->login();
                   echo "Invalid UserName or Password";                
                  }
                }
                else if($submitForm == 'New Users must register here')
                {
                    redirect(base_url() . 'Pages/registerPage');
                }
          }

          public function register()
          {
             $username = $this->input->post('username');
             $password = $this->input->post('password');
             $address = $this->input->post('address');
             $phone = $this->input->post('phone');
             $email = $this->input->post('email');
             if($this->books_models->can_register($username)){
             $userinfo = array('username' => $username,
                            'password' => md5($password),
                            'address' => $address,
                            'phone' => $phone,
                            'email' => $email
                            );
              $this->books_models->register($userinfo);
              $basketid = uniqid();
              $basketinfo = array('basketId' =>  $basketid,
                            'username' =>  $username);
              $this->books_models->createBasketId($basketinfo);
              $this->login();
            }
            else
            {
              $this->load->view('pages/Register');
              echo "Username Already Exists";
            }
          } 

            public function search_result()
            {

               $searchForm = $this->input->get('search');
              if($searchForm == 'SearchByAuthor')
              {
              $searchText = $this->input->get('searchtext');
              $session_data = array('isSearch'=>'SearchByAuthor');
              $this->session->set_userdata($session_data);
              $session_data = array('searchText'=>$searchText);
              $this->session->set_userdata($session_data);
              if(!empty(trim($searchText)))
                {
                $data["books"]=$this->books_models->searchByAuthor(trim($searchText));
                $this->load->view('pages/Search',$data); 
                }
                else
                {
                redirect(base_url().'Pages/search_page');
                } 
              }

              else if($searchForm == 'SearchByBookTitle')
              {
                $searchText = $this->input->get('searchtext');
                $session_data = array('isSearch'=>'SearchByBookTitle');
                $this->session->set_userdata($session_data);
                $session_data = array('searchText'=>$searchText);
                $this->session->set_userdata($session_data);

                
                if(!empty(trim($searchText)))
                {

                $data["books"]=$this->books_models->searchByTitle(trim($searchText));
                $this->load->view('pages/Search',$data); 
                }
                else
                {
                redirect(base_url().'Pages/search_page');
                }
              }

              else if($searchForm == 'Logout')
              {
                $this->session->unset_userdata($session_data);
                $this->session->sess_destroy();   
                redirect(base_url() . 'Pages/login');    
              }
            }

        public function addtocart()
        { 
        $isbn = $this->input->get('isbn');
        $quantity = $this->input->get('quantity');
        $sessionData = $this->books_models->shoppingSession($isbn);

        if(!empty($sessionData))
        {
          $session_temp = array();
         foreach($sessionData->result_array() AS $row) {
          $session_temp['isbn']['isbn']= $isbn;
          $session_temp['isbn']['title']= $row['title'];
          $session_temp['isbn']['authorname']= $row['name'];
          $session_temp['isbn']['price']= $row['price'];
          $session_temp['isbn']['numofstocks']= $row['no'];
          $session_temp['isbn']['quantity']= $quantity;
          $this->session->set_userdata('shoppingbasket',$session_temp);
          foreach ((array)$_SESSION['shoppingbasket'] as $var) 
          {
            if(!empty($_SESSION['shoppingbasket'][$isbn]['isbn']))
               {
             $_SESSION['shoppingbasketFin'][$isbn]['quantity']=$_SESSION['shoppingbasket'][$isbn]['quantity']+$_GET['quantity'];
           }
            else
            {
            $isbn =$var['isbn'];
            $_SESSION['shoppingbasketFin'][$isbn]=array('isbn'=>$var['isbn'],'title'=>$var['title'],'authorname'=>$var['authorname'],
            'price'=>$var['price'],'numofstocks'=>$var['numofstocks'],'quantity'=>$var['quantity']);
            }   
           } 
         } }
        $this->load->view('pages/Search');
        }
         public function buy()
        { 
          $this->load->view('pages/Buy');
        }

        public function transaction()
        {
          $this->books_models->buy();
          $this->session->unset_userdata($session_data);
          $this->session->sess_destroy();   
          redirect(base_url() . 'Pages/login');    
        } 
      } 
