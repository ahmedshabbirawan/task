<?php 
namespace App\Repositories;

use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;
use Illuminate\Support\Facades\DB;


class ProductRepository implements ProductRepositoryInterface
{
    public function getAllProducts(){
        return Product::all();
    }
    public function getProductById($productId){
        return Product::findOrFail($productId);
    }
    
}


?>