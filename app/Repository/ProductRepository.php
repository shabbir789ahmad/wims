<?php 

namespace App\Repository;
use App\Models\ProductStock;
class ProductRepository {

    
    
    public function getAllStock()
    {
        return ProductStock::Branch()
        ->select('stock','stock_sold','pbrand_id')->get();
    }

}

?>