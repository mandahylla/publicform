<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
	public function getUser($username = false, $userID = false)
	{
		if ($username) {
			return $this->db->table('users')
				->select('*,users.id AS userID,user_role.id AS role_id')
				->join('user_role', 'users.role = user_role.id')
				->where(['username' => $username])
				->get()->getRowArray();
		} elseif ($userID) {
			return $this->db->table('users')
				->select('*,users.id AS userID,user_role.id AS role_id')
				->join('user_role', 'users.role = user_role.id')
				->where(['users.id' => $userID])
				->get()->getRowArray();
		} else {
			return $this->db->table('users')
				->select('*,users.id AS userID,user_role.id AS role_id')
				->join('user_role', 'users.role = user_role.id')
				->get()->getResultArray();
		}
	}

	public function getLastInsertID()
	{
		return $this->db->insertID();
	}

	public function getAccessMenuCategory($role)
	{
		return $this->db->table('user_menu_category')
			->select('*,user_menu_category.id AS menuCategoryID')
			->join('user_access', 'user_menu_category.id = user_access.menu_category_id')
			->where(['user_access.role_id' => $role])
			->get()->getResultArray();
	}
	public function getAccessMenu($role)
	{
		return $this->db->table('user_menu')
			->join('user_access', 'user_menu.id = user_access.menu_id')
			->where(['user_access.role_id' => $role])
			->get()->getResultArray();
	}

	public function getUserRole($role = false)
	{
		if ($role) {
			return $this->db->table('user_role')
				->where(['id' => $role])
				->get()->getRowArray();
		}

		return $this->db->table('user_role')
			->get()->getResultArray();
	}

	public function createUser($dataUser)
	{
		return $this->db->table('users')->insert([
			'fullname'		=> $dataUser['inputFullname'],
			'username' 		=> $dataUser['inputUsername'],
			'wphone' 		=> $dataUser['inputTel'],
			'link_code'		=> $dataUser['inputLink'],
			'code_date'		=> $dataUser['inputCodeDate'],
			'password' 		=> password_hash($dataUser['inputPassword'], PASSWORD_DEFAULT),
			'role' 			=> $dataUser['inputRole'],
			'created_at'    => $dataUser['inputCreatedAt']
		]);
	}
	public function updateUser($dataUser)
	{
		if ($dataUser['inputPassword']) {
			$password = password_hash($dataUser['inputPassword'], PASSWORD_DEFAULT);
		} else {
			$user 		= $this->getUser(userID: $dataUser['userID']);
			$password 	= $user['password'];
		}
		return $this->db->table('users')->update([
			'fullname'		=> $dataUser['inputFullname'],
			'username' 		=> $dataUser['inputUsername'],
			'password' 		=> $password,
			'role' 			=> $dataUser['inputRole'],
		], ['id' => $dataUser['userID']]);
	}

	public function updateUserPassword($dataUser)
	{
		$password = password_hash($dataUser['inputPassword'], PASSWORD_DEFAULT);

		return $this->db->table('users')->update([

			'link_code'		=> null,
			'code_date'		=> null,
			'password' 		=> $password,
			'updated_at'	=> $dataUser['inputUpdatedAt'],

		], ['id' => $dataUser['userID']]);
	}

	public function deleteUser($userID)
	{
		return $this->db->table('users')->delete(['id' => $userID]);
	}

	public function createRole($dataRole)
	{
		return $this->db->table('user_role')->insert(['role_name' => $dataRole['inputRoleName']]);
	}
	public function updateRole($dataRole)
	{
		return $this->db->table('user_role')->update(['role_name' => $dataRole['inputRoleName']], ['id' => $dataRole['roleID']]);
	}
	public function deleteRole($role)
	{
		return $this->db->table('user_role')->delete(['id' => $role]);
	}
	public function checkUserMenuCategoryAccess($dataAccess)
	{
		return  $this->db->table('user_access')
			->where([
				'role_id' => $dataAccess['roleID'],
				'menu_category_id' => $dataAccess['menuCategoryID']
			])
			->countAllResults();
	}

	public function checkUserAccess($dataAccess)
	{
		return  $this->db->table('user_access')
			->where([
				'role_id' => $dataAccess['roleID'],
				'menu_id' => $dataAccess['menuID']
			])
			->countAllResults();
	}

	public function checkUserSubmenuAccess($dataAccess)
	{
		return  $this->db->table('user_access')
			->where([
				'role_id' => $dataAccess['roleID'],
				'submenu_id' => $dataAccess['submenuID']
			])
			->countAllResults();
	}
	public function insertMenuCategoryPermission($dataAccess)
	{
		return $this->db->table('user_access')->insert(['role_id' => $dataAccess['roleID'], 'menu_category_id' => $dataAccess['menuCategoryID']]);
	}
	public function deleteMenuCategoryPermission($dataAccess)
	{
		return $this->db->table('user_access')->delete(['role_id' => $dataAccess['roleID'], 'menu_category_id' => $dataAccess['menuCategoryID']]);
	}

	public function insertMenuPermission($dataAccess)
	{
		return $this->db->table('user_access')->insert(['role_id' => $dataAccess['roleID'], 'menu_id' => $dataAccess['menuID']]);
	}
	public function deleteMenuPermission($dataAccess)
	{
		return $this->db->table('user_access')->delete(['role_id' => $dataAccess['roleID'], 'menu_id' => $dataAccess['menuID']]);
	}

	public function insertSubmenuPermission($dataAccess)
	{
		return $this->db->table('user_access')->insert(['role_id' => $dataAccess['roleID'], 'submenu_id' => $dataAccess['submenuID']]);
	}
	public function deleteSubmenuPermission($dataAccess)
	{
		return $this->db->table('user_access')->delete(['role_id' => $dataAccess['roleID'], 'submenu_id' => $dataAccess['submenuID']]);
	}

	public function verifyToken($token)
	{
		$result = $this->db->table('users')
				 		   ->select('id,fullname,username,link_code,code_date,is_active')
				 		   ->where('link_code',$token)
				 		   ->get();

		if(!empty($result))
		{
			return $result->getRowArray();
		}
		return false;
	}

	public function verifyEmail($email)
		{
			$result = $this->db->table('users')
					 		   ->select('id,link_code,is_active,fullname,password')
					 		   ->where('username',$email)
					 		   ->get();

			if(!empty($result))
			{
				return $result->getRowArray();
			}
			return false;
		}

	public function activate($link,$activateAt)
	{
		$this->db->table('users')
				 ->where('link_code',$link)
				 ->update([
				 			'is_active'    => 1,
				 			'activated_at' => $activateAt
				 		]);

	 	if($this->db->affectedRows() == 1)
	 	{
	 		return true;
	 	}
	 	return false;
	}

	public function updateLink($userId, $link,$link_date,$update_at)
	{
		$this->db->table('users')
				 ->where('id',$userId)
				 ->update([
				 			'link_code'  => $link,
				 			'code_date'  => $link_date,
				 			'updated_at' => $update_at
				 		]);

	 	if($this->db->affectedRows() == 1)
	 	{
	 		return true;
	 	}
	 	return false;
	}

// mise en place de la fonction de modification du mot de pass dans la bd
	public function updatePassword($userId, $password,$dateUpdate)
	{
		$this->db->table('users')
				 ->where('id',$userId)
				 ->update([
				 			'password'   => $password,
				 			'link_code'  => null,
				 			'code_date'  => null,
				 			'updated_at' => $dateUpdate

				 		]);

	 	if($this->db->affectedRows() == 1)
	 	{
	 		return true;
	 	}
	 	return false;
	}
// teste pour enregistrement à plusieurs étapes
	function insert_user($name, $password, $email, $phone, $gender, $dob, $address) {
        $data = array('name' => $name, 'password' => md5($password), 'email' => $email, 'phone' => $phone, 'gender' => $gender, 'dob' => $dob, 'address' => $address);
        $result = $this->db->table('users')->insert($data);
        if ($result !== NULL) {
            return TRUE;
        }
        return FALSE;
    }
}
