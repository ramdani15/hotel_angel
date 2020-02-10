<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\Rooms;
use App\Books;
use App\Payments;


class BookController extends Controller
{
	public function index(Request $request){
    	return Books::all();
    }

    public function show(Request $request, $id){
    	return Books::find($id);
    }

    public function destroy(Request $request, $id){
    	if(app(PermissionController::class)->isAdmin($request->user()->role)){
    		$book = Books::find($id);

    		Rooms::where('_id', $book->room_id)->update([
    			"status" => "available",
    		]);
	        
	        Books::destroy($id);

	        return response()->json(["status" => 'Deleted'], 200);
    	}
    	return response()->json(["status" => 'You don\'t have permission'], 403);
    }

    public function cancel(Request $request, $id){
    	if(app(PermissionController::class)->isAdmin($request->user()->role)){
    		$book = Books::find($id);
    		$book->paid = false;
    		$book->save();
    		
    		// rollback room status
    		$room = Rooms::find($book->room_id);
    		$room->status = "available";
    		$room->save();

    		return response()->json(["status" => 'Cancel Booking'], 200);
    	}
    	return response()->json(["status" => 'You don\'t have permission'], 403);
    }

    public function cancel_all(Request $request){
    	if(app(PermissionController::class)->isAdmin($request->user()->role)){    		
    		
    		// set available all room
    		$room = Rooms::update([
    			"status" => "available",
    		]);

    		return response()->json(["status" => 'Cancel All Booking'], 200);
    	}
    	return response()->json(["status" => 'You don\'t have permission'], 403);
    }

    public function payment(Request $request, $id){
    	if(app(PermissionController::class)->customerOfBook($request->user()->_id, $id)){
    		$book = Books::find($id);
    		
    		// Check booking paid
    		if($book->paid == true){
    			return response()->json(["status" => 'Book Already Paid'], 404);
    		}

    		$payment = Payments::create([
    			"book_id" => $book->_id,
    			"receive" => false,
    			"verify_by" => null,
    		]);

    		return $payment;
    	}
    	return response()->json(["status" => 'You don\'t have permission'], 403);
    }
}
