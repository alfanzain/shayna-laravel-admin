<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductCollection;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * The resource instance.
     *
     * @var mixed
     */
    public $products;

    public function __construct(Request $request)
    {
        $request->validate([
            'price_from' => 'numeric|min:1',
            'price_to' => 'numeric|min:1',
        ]);

        $this->products = new Product;

        if($request->input('gallery'))
        {
            if($request->input('gallery') == 'true')
            {
                if(!$request->input('gallery_default') || $request->input('gallery_default') == 'false')
                {
                    $this->products = $this->products->with('galleries');
                }
                else if($request->input('gallery_default') && $request->input('gallery_default') == 'true')
                {
                    $this->products = $this->products->with(['galleries' => function ($query) {
                        $query->where('is_default', '1');
                    }]);
                }
            }
        }

        if($request->input('price_from'))
        {
            $this->products = $this->products->where('price', '>=', $request->input('price_from'));
        }

        if($request->input('price_to'))
        {
            $this->products = $this->products->where('price', '<=', $request->input('price_to'));
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->validate([
            'per_page' => 'numeric|min:1|max:1000',
        ]);

        $this->products = $this->products->paginate($request->input('per_page', 25));

        return new ProductCollection($this->products);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $query)
    {
        if(is_numeric($query))
        {
            $product = $this->products->find($query);
    
            return new ProductResource($product);
        }
        else
        {
            $request->validate([
                'per_page' => 'numeric|min:1|max:1000',
            ]);

            $products = $this->products
                ->where("name", "LIKE", "%" . $query . "%")
                ->paginate($request->input('per_page', 25));
    
            return new ProductCollection($products);
        }
    }
}
