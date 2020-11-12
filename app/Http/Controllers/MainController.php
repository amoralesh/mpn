<?php

namespace App\Http\Controllers;

/* CONTROLADOR */
use App\Http\Controllers\Controller;

/* ENTITIES */

/* DAOS */
      
/* LIBRERIAS */
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use File;


class MainController extends Controller
{

  /* ENTITIES DAO */
 
  public function __construct()   
  {
    /* ENTITIES DAO */
   
  }
  
  public function index()
  { 
     return view('index');
  }





}


