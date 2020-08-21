<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class Pages extends BaseController
{
    public function index()
    {
        $data = [];
        helper(['form']);

        if ($this->request->getMethod() == 'post'){
            // validate
            $rules = [
				'email' => 'required|min_length[6]|max_length[50]|valid_email',
				'password' => 'required|min_length[8]|max_length[255]|validateUser[email,password]',
            ];
            // unique error message
            $errors = [
				'password' => [
					'validateUser' => 'Email or Password don\'t match'
				]
            ];
            // return error
            if (! $this->validate($rules,$errors)){
                $data['validation'] = $this->validator;
            } else {
                // if login valid, direct to dashboard
                $model = new UserModel();
				$user = $model->where('email', $this->request->getVar('email'))
                                ->first();
                if ($user['user_status'] == 0 ){
                    session()->setFlashdata('error', "Inactivated account");
                } else {
                    $this->setUserSession($user);
				    return redirect()->to('/k24/public/dashboard');
                }	
            }
        }
        echo view("templates/start-header", $data);
        echo view("pages/login");
        echo view("templates/footer");
    }

    private function setUserSession($user){
        $data = [
            'user_id' => $user['user_id'],
            'fname' => $user['fname'],
            'lname' => $user['lname'],
            'email' => $user['email'],
            'role_id' => $user['role_id'],
            'isLoggedIn' => true,
        ];
        session()-> set($data);
    }

    public function signup()
    {
        $data = [];
        helper(['form']);

        if ($this->request->getMethod() == 'post'){
            // validate signup 
            $rules = [
                'fname' => 'required|min_length[3]|max_length[20]',
				'lname' => 'required|min_length[3]|max_length[20]',
				'email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[users.email]',
				'password' => 'required|min_length[8]|max_length[255]',
				'password_confirm' => 'matches[password]',
            ];
            // Return errors? 
            if (! $this->validate($rules)){
                $data['validation'] = $this->validator;
            } else {
                // if no errors, insert into DB
                $model = new UserModel();
                $newData = [
                    'fname'=> $this->request->getVar('fname'),
                    'lname'=> $this->request->getVar('lname'),
                    'email'=> $this->request->getVar('email'),
                    'password'=> $this->request->getVar('password')
                ];
                $model->save($newData); 
                $session = session();
                $session->setFlashData('success', 'Signed up!');
                return redirect()->to('/k24/public/');
            }
        }
        echo view("templates/start-header", $data);
        echo view("pages/signup");
        echo view("templates/footer");
    }

    public function profile(){
		
		$data = [];
		helper(['form']);
		$model = new UserModel();

		if ($this->request->getMethod() == 'post') {
			//let's do the validation here
			$rules = [
				'fname' => 'required|min_length[3]|max_length[20]',
				'lname' => 'required|min_length[3]|max_length[20]',
				];

			if($this->request->getPost('password') != ''){
				$rules['password'] = 'required|min_length[8]|max_length[255]';
				$rules['password_confirm'] = 'matches[password]';
			}


			if (! $this->validate($rules)) {
				$data['validation'] = $this->validator;
            }else{
				$newData = [
					'user_id' => session()->get('user_id'),
					'fname' => $this->request->getPost('fname'),
                    'lname' => $this->request->getPost('lname'),  
                    ];
                    
					if($this->request->getPost('password') != ''){
						$newData['password'] = $this->request->getPost('password');
                    }
                
				$model->save($newData);
                
				session()->setFlashdata('success', 'Successfuly Updated');
				return redirect()->to('/k24/public/Pages/profile');

			}
		}
        
        $data['user'] = $model->where('user_id', session()->get('user_id'))->first();
		echo view('templates/dashboard-header', $data);
		echo view('pages/profile');
		echo view('templates/footer');
    }
    
    public function logout(){
        session()->destroy();
		return redirect()->to('/k24/public/');
    }
    
}