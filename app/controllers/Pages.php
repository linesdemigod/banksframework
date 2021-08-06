<?php
class Pages extends Controller
{
  public function __construct()
  {
  }

  // Load Homepage
  public function index()
  {
   

    //Set Data
    $data = [
      'title' => 'Welcome To BankMVC',
      'description' => 'Simple social network built on the BanksMVC PHP framework'
    ];

    // Load homepage/index view
    $this->view('pages/index', $data);
  }

  public function about()
  {
    //Set Data
    $data = [
      'version' => '1.0.0'
    ];

    // Load about view
    $this->view('pages/about', $data);
  }

  public function contact()
  {

    $this->view('pages/contact');
  }
}
