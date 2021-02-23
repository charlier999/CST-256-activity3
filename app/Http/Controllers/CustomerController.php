<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerModel;
use App\Services\Business\SecurityService;

class CustomerController extends Controller
{
    public function addCustomer(Request $request)
    {
        $secService = new SecurityService();
        
        // Craete Customer Model from HTTP request
        $customerData = new CustomerModel(
            0, 
            $request->get('firstName'), 
            $request->get('lastName')
            );
        
        
        $isValid = $secService->addCustomer($customerData);
        
        if($isValid)
        {
            echo " Customer Data Added Successfully";
        }
        else
        {
            echo " Customer Data Was Not Added";
        }
        return view('customer');
    }

}

