<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\Rooms;
use App\Books;


class RoomController extends Controller
{
    public function index(Request $request){
    	return Rooms::all();
    }

    public function store(Request $request){
    	if(app(PermissionController::class)->isAdmin($request->user()->role)){
    		$validator = Validator::make($request->all(), [
	            'name' => 'required|string|max:255',
	            'price' => 'required|integer',
	        ]);

	        if($validator->fails()){
	            return response()->json($validator->errors()->toJson(), 400);
	        }

	        $room = Rooms::create([
	        	"name" => $request->name,
	        	"status" => 'available',
	        	"price" => $request->price,
	        ]);

	        return $room;
    	}
    	return response()->json(["status" => 'You don\'t have permission'], 403);
    }

    public function show(Request $request, $id){
    	return Rooms::find($id);
    }

    public function edit(Request $request, $id){
    	if(app(PermissionController::class)->isAdmin($request->user()->role)){
    		$validator = Validator::make($request->all(), [
	            'name' => 'required|string|max:255',
	            'price' => 'required|integer',
	        ]);

	        if($validator->fails()){
	            return response()->json($validator->errors()->toJson(), 400);
	        }

	        Rooms::where('_id', $id)->update([
	        	"name" => $request->name,
	        	"price" => $request->price,
	        ]);

	        return Rooms::find($id);
    	}
    	return response()->json(["status" => 'You don\'t have permission'], 403);
    }

    public function destroy(Request $request, $id){
    	if(app(PermissionController::class)->isAdmin($request->user()->role)){
	        Rooms::destroy($id);

	        return response()->json(["status" => 'Deleted'], 200);
    	}
    	return response()->json(["status" => 'You don\'t have permission'], 403);
    }

    public function booking(Request $request, $id){
    	if(app(PermissionController::class)->isCustomer($request->user()->role)){
    		$room = Rooms::find($id);
    		
    		// Check room status
    		if($room->status == 'booked'){
    			return response()->json(["status" => 'Room Already Booked'], 404);
    		}

    		$book = Books::create([
    			"room_id" => $id,
    			"customer_id" => $request->user()->_id,
    			"date" => $request->date,
    			"paid" => false,
    		]);

    		// update status room
    		$room->status = 'booked';
    		$room->save();

    		return $book;
    	}
    	return response()->json(["status" => 'You don\'t have permission'], 403);
    }
}
