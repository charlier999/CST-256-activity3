<?php
namespace App\Services\Business;

use App\Models\OrderModel;
use App\Models\UserModel;
use App\Services\Data\SecurityDAO;
use App\Services\Data\CustomerDAO;
use App\Models\CustomerModel;
use App\Services\Data\OrderDAO;

class SecurityService
{
    private SecurityDAO $secDAO;
    private CustomerDAO $custDAO;
    private OrderDAO $orderDAO;
    
    public function __construct()
    {
        $this->secDAO = new SecurityDAO();
        $this->custDAO = new CustomerDAO();
        $this->orderDAO = new OrderDAO();
    }
    
    public function login(UserModel $user)
    {
        return $this->secDAO->DoesUserExist($user);
    }
    
    public function addCustomer(CustomerModel $customer)
    {
        return $this->custDAO->addCustomer($customer);
    }
    
    public function addOrder(OrderModel $order)
    {
        return $this->orderDAO->addOrder($order);
    }
}

