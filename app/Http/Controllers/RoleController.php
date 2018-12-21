<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\Models\Role;
use App\Models\Permission;

use DB;
use Auth;
use Entrust;


class RoleController extends Controller
{
	public function getCreaterole()
	{
		// $owner = new Role();
		// $owner->name = 'admin';
		// $owner->display_name = 'แอดมิน'; // optional
		// $owner->description = 'แอดมินทำได้ทุกอย่าง'; // optional
		// $owner->save();

		// $admin = new Role();
		// $admin->name = 'user';
		// $admin->display_name = 'ยูสเซอร์'; // optional
		// $admin->description = 'ผู้ใช้งานทั่วไป'; // optional
		// $admin->save();
	}

	public function getAddusertorole()
	{
		$admin = new Role();

		$user = User::where('email', '=', 'unisexx@gmail.com')->first();
		
		// role attach alias
		// $user->attachRole($admin); // parameter can be an Role object, array, or id
		
		// or eloquent's original technique
		$user->roles()->attach(1); // id only
	}

	public function getAddpermissiontorole()
	{
		$admin = Role::find(1);

		$createPost = new Permission();
		$createPost->name = 'create-page';
		$createPost->display_name = 'สร้างหน้าเพจ'; // optional
		// Allow a user to...
		$createPost->description = 'สร้างหน้าเมนูเพจ'; // optional
		$createPost->save();

		// $editUser = new Permission();
		// $editUser->name = 'edit-user';
		// $editUser->display_name = 'Edit Users'; // optional
		// // Allow a user to...
		// $editUser->description = 'edit existing users'; // optional
		// $editUser->save();

		$admin->attachPermission($createPost);
		// equivalent to $admin->perms()->sync(array($createPost->id));

		// $admin->attachPermissions(array($createPost, $editUser));
		// equivalent to $owner->perms()->sync(array($createPost->id, $editUser->id));
	}

	public function getCheckpermission()
	{
		$user = User::find(1);
		// dump($user->hasRole('user'));   // false
		// dump($user->hasRole('admin'));   // true
		// dump($user->can('create-post'));   // false
		// dump($user->can('create-page')); // true

		// Both hasRole() and can() can receive an array of roles & permissions to check:
		// มีอย่างน้อย 1 permission
		// dump($user->hasRole(['admin', 'user']));       // true
		// dump($user->can(['create-page', 'create-post'])); // true

		// By default, if any of the roles or permissions are present for a user then the method will return true. Passing true as a second parameter instructs the method to require all of the items:
		// $user->hasRole(['owner', 'admin']);             // true
		// $user->hasRole(['owner', 'admin'], true);       // false, user does not have admin role
		// $user->can(['edit-user', 'create-post']);       // true
		// $user->can(['edit-user', 'create-post'], true); // false, user does not have edit-user permission

		// The Entrust class has shortcuts to both can() and hasRole() for the currently logged in user:
		dump(Entrust::hasRole('admin'));
		// Entrust::can('permission-name');
		
		// is identical to

		// dump(Auth::user()->hasRole('admin'));
		// Auth::user()->can('permission-name');
	}
}
