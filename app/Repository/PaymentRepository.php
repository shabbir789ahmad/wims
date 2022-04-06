<?php 

namespace App\Repository;
use App\Models\Payment;
class PaymentRepository {

    
    
    public function getAllPayments()
    {
        return Payment::Branch()
        ->join('orders','payments.id','=','orders.payment_id')
        ->select('orders.id','orders.payment_id','payments.biller_name','orders.product_name','orders.quentity','orders.tax','orders.sub_total','payments.created_at')
        ->latest('payments.created_at')
        ->where('orders.deleted_at',null)
        ->paginate(100);
    }

}

?>