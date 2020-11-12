<?php

namespace App\Http\Controllers\Publico;

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
    $this->middleware('auth:webpublico');   
    $this->middleware('hasPermission:Publico:Aside:Dashboard',[ 'only' => ['index']] );

    /* ENTITIES DAO */ 
  }
   
  public function index()
  { 
     return view('publico.dashboard');
  }  





}


