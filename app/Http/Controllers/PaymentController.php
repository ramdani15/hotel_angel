<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\Rooms;
use App\Books;
use App\Payments;


class PaymentController extends Controller
{
	public function index(Request $request){
		if(app(PermissionController::class)->isAdmin($request->user()->role)){
    		return Payments::all();
		}
    	return response()->json(["status" => 'You don\'t have permission'], 403);
    }

    public function show(Request $request, $id){
    	if(app(PermissionController::class)->isAdmin($request->user()->role)){
    		return Payments::find($id);
    	}
    	return response()->json(["status" => 'You don\'t have permission'], 403);
    }

    public function destroy(Request $request, $id){
    	if(app(PermissionController::class)->isAdmin($request->user()->role)){
	        Payments::destroy($id);

	        return response()->json(["status" => 'Deleted'], 200);
    	}
    	return response()->json(["status" => 'You don\'t have permission'], 403);
    }

    public function allow(Request $request, $id){
    	if(app(PermissionController::class)->isAdmin($request->user()->role)){
    		$payment = Payments::find($id);
    		
    		// Check payment receive
    		if($payment->receive == true){
    			return response()->json(["status" => 'Payments Already Received'], 404);
    		}

    		// update booking paid
    		Books::where('_id', $id)->update([
    			"paid" => true,
    		]);

    		// update payment recieve
    		Payments::where('_id', $id)->update([
    			"receive" => true,
    			"verify_by" => $request->user()->_id,
    		]);

    		return Payments::find($id);
    	}
    	return response()->json(["status" => 'You don\'t have permission'], 403);
    }

    public function deny(Request $request, $id){
    	if(app(PermissionController::class)->isAdmin($request->user()->role)){
    		$payment = Payments::find($id);
    		
    		// Check payment receive
    		if($payment->receive == false){
    			return response()->json(["status" => 'Payments Already Deny'], 404);
    		}

    		Payments::where('_id', $id)->update([
    			"receive" => deny,
    			"verify_by" => $request->user()->_id,
    		]);

    		return Payments::find($id);
    	}
    	return response()->json(["status" => 'You don\'t have permission'], 403);
    }
}
