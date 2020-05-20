<?php namespace App\Filters;

/*
 * @author Nikola Milicevic 0387/17
 * 
 */

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AdminFilter implements FilterInterface
{
    public function before(RequestInterface $request)
    {
        $session=session();
        if(!$session->has('korisnik')){
            return redirect()->to(site_url('Gost'));
        }
        //var_dump($request->uri->getPath());
        if(strpos($request->uri->getPath(),"logout")){
            $session->destroy();
            return redirect()->to(site_url('Gost'));
        }
            //return redirect()->to(site_url('Korisnik'));
       if($session->has('korisnik') && $session->get('korisnik')->tip == "obican"){

           return redirect()->back();
        }
   
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response)
    {
        // Do something here
    }
}