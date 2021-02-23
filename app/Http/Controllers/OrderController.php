<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerModel;
use App\Services\Data\CustomerDAO;
use App\Services\Business\SecurityService;
use App\Models\OrderModel;

class OrderController extends Controller
{
    public function addOrder(Request $request)
    {
        $custDAO = new CustomerDAO();
        $secService = new SecurityService();
        
        $product = $request->input("product");
        $custID = $request->input("custID");
        
        // If customer does not exist
        if(!$custDAO->doesCustomerExist($custID))
        {
            echo "Customer " . $custID . " does not exist.";
            return View("orders");
        }
        
        $order = new OrderModel(0, $custID, $product);
        
        $result = $secService->addOrder($order);
        
        if($result) 
        {
            echo "Added order correctly";
            return View("orders");
        
        }
        else 
        {
            echo "Failed to add order";
            return View("orders");
        }
    }

}

