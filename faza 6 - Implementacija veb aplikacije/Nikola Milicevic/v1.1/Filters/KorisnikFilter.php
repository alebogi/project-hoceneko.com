<?php namespace App\Filters;

/*
 * @author Nikola Milicevic 0387/17
 * 
 */

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class KorisnikFilter implements FilterInterface
{
    public function before(RequestInterface $request)
    {
        $session=session();
        if(!$session->has('korisnik')){
            return redirect()->to(site_url('Gost'));
        }
        
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response)
    {
        // Do something here
    }
}