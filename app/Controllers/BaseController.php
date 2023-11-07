<?php

namespace App\Controllers;

use App\Libraries\Const_lib;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Libraries\Phpmailer_lib;
use App\Models\UserModel;
use App\Models\MenuModel;
use App\Models\BankAccountModel;
use App\Models\DemandModel;
use App\Models\StatusModel;
use App\Models\UploadFileModel;
use App\Models\CountryModel;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */

class BaseController extends Controller
{
	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers 	= ['cookie', 'date', 'security', 'menu', 'useraccess','form','text','userdemands'];
	/**
	 * Constructor.
	 *
	 * @param RequestInterface  $request
	 * @param ResponseInterface $response
	 * @param LoggerInterface   $logger
	 */


	protected $data 	= [];
	protected $userModel;
	protected $session;
	protected $segment;
	protected $db;
	protected $validation;
	protected $encrypter;
	protected $pager;
	protected $mail;
	protected $menuModel;
	protected $bankAccountModel;
	protected $demandModel;
	protected $statusModel;
	protected $uploadModel;
	protected $domPdf;
	protected $const;
	protected $countryModel;

	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);
		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		$this->session 				= \Config\Services::session();
		$this->segment 	  			= \Config\Services::request();
		$this->db         			= \Config\Database::connect();
		$this->validation 			= \Config\Services::validation();
		$this->encrypter 			= \Config\Services::encrypter();
		$this->pager 				= \config\Services::pager();
		$this->domPdf				= new \Dompdf\Dompdf();
		$this->const				= new Const_lib();
		$this->mail 			  	= new Phpmailer_lib();
		$this->userModel  			= new UserModel();
		$this->menuModel  			= new MenuModel();
		$this->bankAccountModel  	= new BankAccountModel();
		$this->demandModel  		= new DemandModel();
		$this->statusModel          = new StatusModel();
		$this->uploadModel			= new UploadFileModel();
		$this->countryModel			= new CountryModel();
		
		$user 						= $this->userModel->getUser(username: session()->get('username'));
		$segment 					= $this->request->getUri()->getSegment(1);
		if ($segment) {
			$subsegment 			= $this->request->getUri()->getSegment(2);
		} else {
			$subsegment 			= '';
		}
		$this->data			= [
			'segment' 		=> $segment,
			'subsegment' 	=> $subsegment,
			'user' 			=> $user,
			'MenuCategory' 	=> $this->userModel->getAccessMenuCategory(session()->get('role'))
		];
	}
}
