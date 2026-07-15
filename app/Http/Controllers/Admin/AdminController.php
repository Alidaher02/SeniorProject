<?php

namespace App\Http\Controllers\Admin;

use App\Models\Shipment;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Enums\ShipmentStatus;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;


class AdminController extends Controller
{
//    public function index(){

//     Gate::authorize('admin.admin');


//     return view('admin.admin');
//    }

   public function shipmentsView(){

       Gate::authorize('admin.admin');


        return view('admin.adminShipments' , [

            'shipments' => Shipment::where('status' , '!=' , 'pending')->latest()->get()
        ]);
   }

   public function customersView(){

        return view('admin.customers' , [
            'customers' => User::where('role' , 'customer')->get()
        ]);
   }

   public function alertsView(){

        return view('admin.alerts');
   }

   public function requests(){

        return view('admin.requests' , [
            'shipments' => Shipment::where('status' , 'pending')->latest()->get()
        ]);
   }

   public function intransit(){

        return view('admin.intransit' , [
            'shipments' => Shipment::where('status' , 'in_transit')->latest()->get()
        ]);
   }

   public function delivered(){

        return view('admin.delivered' , [
            'shipments' => Shipment::where('status' , 'delivered')->latest()->get()
        ]);
   }

   public function approved(){

        return view('admin.approved' , [
            'shipments' => Shipment::where('status' , 'approved')->latest()->get(),
            'drivers' => User::where('role' , 'driver')->latest()->get()
        ]);
   }

   public function showAdminShipments(Shipment $shipment){

     return view('admin.showAdminShipment', [
          'shipment' => $shipment
     ]);
   }

   public function drivers(Request $request){

     return view('admin.drivers', [
          'drivers' => User::where('role' , 'driver')->withCount('assignedShipments')->get()
     ]);
   }

   public function addDrivers(Request $request){

        $request->validate([
        'name' => ['required' , 'string' , 'max:255'],
        'email' => ['required' , 'string' , 'email' , 'max:255' , 'unique:users'],
        'password' => ['required' , 'string' , Password::default()]
      ]);

     $user = User::create([
        'name' => request('name'),
        'email' => request('email'),
        'role' => 'driver',
        'password' => Hash::make($request->password)
     ]);

      return redirect('/admin/drivers')->with('success' , 'Your Successfully Registered!');
   }

   public function deleteDriver(User $driver)
{
    if($driver->role !== 'driver'){
        abort(403);
    }

    $driver->delete();

    return redirect('/admin/drivers')
        ->with('success','Driver deleted');
}



   public function addCustomers(Request $request){

          $request->validate([
        'name' => ['required' , 'string' , 'max:255'],
        'email' => ['required' , 'string' , 'email' , 'max:255' , 'unique:users'],
        'password' => ['required' , 'string' , Password::default()]
      ]);

     $user = User::create([
        'name' => request('name'),
        'email' => request('email'),
        'role' => 'customer',
        'password' => Hash::make($request->password)
     ]);

      return redirect('/admin/customers')->with('success' , 'Your Successfully Registered!');
   }

   public function deleteCustomer(User $customer){
     
          if($customer->role !== 'customer'){
            abort(403);
          }

          $customer->delete();
          
          return redirect('/admin/customers');
     
   }


    
   public function stats(){
    return response()->json([
     'total' => Shipment::count(),
     'pending' => Shipment::where('status' , 'pending')->count(),
     'approved' => Shipment::where('status' , 'approved')->count(),
     'delivered' => Shipment::where('status' , 'delivered')->count(),
     'in_transit' => Shipment::where('status' , 'in_transit')->count(),
     'rejected' => Shipment::where('status' , 'rejected')->count(),
     'totalCustomers' => User::where('role' , 'customer')->count(),
    ]);
   }
    public function updatePending(Request $request, Shipment $shipment)
    {   
        $shipment->update([
            'status' => ShipmentStatus::APPROVED
        ]);

            return back()->with('success', 'Shipment approved!');

    }


    public function updateApproved(Request $request, Shipment $shipment)
    {  
         $request->validate([
            'driver_id' => ['required']
         ]);    

        $shipment->update([
            'status' => ShipmentStatus::IN_TRANSIT,
            'driver_id' => request('driver_id')
        ]);
        
            return back()->with('success', 'Shipment Being Delivered!');

    }


    public function rejectShipment(Request $request, Shipment $shipment)
    {  
        $shipment->update([
            'status' => ShipmentStatus::REJECTED
        ]);

            return back()->with('success', 'Shipment Rejected!');

    }


   
}
