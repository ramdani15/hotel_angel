<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Books;


class PermissionController extends Controller
{
    public function isAdmin($role){
    	if($role == 'admin'){
    		return true;
    	}
    	return false;
    }

    public function isCustomer($role){
    	if($role == 'customer'){
    		return true;
    	}
    	return false;
    }

    public function customerOfBook($user_id, $id){
    	$user = User::find($user_id);
    	$book = Books::find($id);
    	if(Self::isCustomer($user->role) && $book->customer_id == $user->_id){
    		return true;
    	}
    	return false;
    }

    public function usersPermission($username, $user_id){
        $user = User::find($user_id);
        $owner = User::where('username', $username)->first();
        if($user != null || $owner != null){
            if(Self::isCustomer($user->role)){
                if(Self::addBooks($owner->role) || $user->_id == $owner->_id){
                    return true;
                }
            } else if(Self::isAdmin($user->role)){
                if($user->_id == $owner->_id){
                    return true;
                }
            }
            return false;
        }
        return abort(404);

    }
}
