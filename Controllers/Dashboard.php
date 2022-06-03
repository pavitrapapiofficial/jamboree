<?php namespace App\Controllers;
  
use CodeIgniter\Controller;
  
class Dashboard extends Controller
{
    public function index()
    {
        $session = session();
        // echo base_url();
        echo "Jamboree welcomes you, ".$session->get('user_name');
        echo "<br><a href='/login/logout'>logout</a>";
        echo "<br><a href='/todo'>create TODO</a>";
        echo "<br><a href='/todo/list'>List TODO</a>";
    }
}