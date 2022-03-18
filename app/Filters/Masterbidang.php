<?php

namespace App\Filters;

use App\Models\OrganisasiModel;
use App\Models\WebModel;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Masterbidang implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $organisasi = new OrganisasiModel();
        $web = new WebModel();
        $data = $organisasi->getOrganisasi();
        $data2 = $web->getWeb();
        if (count($data) == 0 or count($data2) == 0) {
            return redirect()->to(base_url('/noapp'));
        }
        if (!session()->get('level') && !session()->get('nama')) {
            return redirect()->to(base_url('/404'));
        } elseif (!session()->get('level') == 'admin') {
            return redirect()->to(base_url('/errors'));
        } elseif (session()->get('level') == 'member') {
            if (!session()->get('masterbidang')) {
                return redirect()->to(base_url('/errors'));
            }
        }
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
