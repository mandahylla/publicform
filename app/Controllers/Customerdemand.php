<?php
		namespace App\Controllers;
		use App\Controllers\BaseController;
		class Customerdemand extends BaseController
		{
			public function index()
			{
				$data = array_merge($this->data, [
					'title'         => 'Demande'
				]);
				return view('demandeList', $data);
			}
			public function form()
			{
				$data = array_merge($this->data, [
					'title'         => 'Demande'
				]);
				return view('demandeForm', $data);
			}
		}
		