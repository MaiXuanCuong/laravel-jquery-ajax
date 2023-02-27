<?php
namespace App\Http\Controllers;
use App\Models\Banner;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Customer;
use App\Models\District;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Province;
use App\Models\Ward;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ShopController extends Controller
{

   public function page(Request $request){
    switch ($request->page) {
        case 'product-detail-page':
            $banners = Banner::where('status', '<>', 0)->get();
            $product = Product::with('product_images','category','supplier','sizes')->find($request->id);
            $params = [
                'product' => $product,
                 'banners' => $banners,
                 
            ];
            // $params = $this->mainHome($product);
            $page = view('shop.components.productdetail',$params)->render();
            break;
        default:
    }

   

    return response()->json(['html' => $page,
    'products' => $this->getHistoryProduct()]);
   }

    // public function getBanner(){
    //     $banners = Banner::where('status', '<>', 0)->get();
    //     return  $banners;
    // }
    public function mainHome($product = null){
        $banners = Banner::where('status', '<>', 0)->get();
        $categories = Category::whereNull('deleted_at')->whereHas('products', function ($query) {
            $query->where('products.status','=',1);
        })->get();
        $products = Product::with('category', 'supplier')
        ->whereNull('deleted_at')
        ->whereHas('category', function ($query) {
            $query->whereNull('deleted_at');
        })
        ->whereHas('supplier', function ($query) {
            $query->whereNull('deleted_at');
        })
        ->get();
        $param = [
            'categories' => $categories,
            'banners' => $banners,
            'products' => $products,
            'product' => $product,
        ];
       return $param;
    }
    public function index()
    {
        $banners = Banner::where('status', '<>', 0)->get();
        $categories = Category::whereNull('deleted_at')->whereHas('products', function ($query) {
            $query->where('products.status','=',1);
        })->get();
        $products = Product::with('category', 'supplier')
        ->whereNull('deleted_at')
        ->whereHas('category', function ($query) {
            $query->whereNull('deleted_at');
        })
        ->whereHas('supplier', function ($query) {
            $query->whereNull('deleted_at');
        })
        ->get();
        $param = [
            'categories' => $categories,
            'banners' => $banners,
            'products' => $products,
        ];
        return view('shop.main', $param);
    }

    public function getHistoryProduct(){
        try {
            if (isset(auth('api')->user()->id)) {
                $user = auth('api')->user()->id;
                $historyProducts = [];
                $historyProduct = Cache::get('historyProducts'.$user);
                if (isset($historyProduct)) {
                   $historyProducts = array_values($historyProduct);
                }
                } else {
                    $historyProducts = [];
                } 
                return response()->json([
                    'historyProducts' => $historyProducts,
                    'status' => 200
                ]);
        } catch (\Exception $e) {
            Log::error('message: ' . $e->getMessage() . ' line: ' . $e->getLine() . ' file: ' . $e->getFile());
            return response()->json([
                'status' => 401
            ]);
        }

    }
    
    public function getCart(){
        try {
        if (isset(auth('api')->user()->id)) {
            $user = auth('api')->user()->id;
            $carts = Cache::get('carts'.$user);
            if (isset($carts[$user])){
                $carts = array_values($carts);
            }
            } else {
                $carts = [];
            } 
            return response()->json([
                'carts' => $carts,
                'status' => 200
            ]);
        } catch (\Exception $e) {
            Log::error('message: ' . $e->getMessage() . ' line: ' . $e->getLine() . ' file: ' . $e->getFile());
            return response()->json([
                'status' => 401
            ]);
        }
    }
    
    public function view($id)
    {
        $product = Product::with('category')->find($id);
       
        try {
            if(isset(auth('api')->user()->id)){
            $user = auth('api')->user()->id;
            $historyProducts = Cache::get('historyProducts'.$user);
                if(!isset($historyProducts[$id])){
                    $historyProducts[$id] = [
                        'id' => $id,
                        'name' => $product->name,
                        'price' => $product->price,
                        'image' => $product->image,
                        'discount' => $product->discount,
                        'category' => $product->category->name,
                    ];
                } 
                $expiresAt = Carbon::now()->addMinutes(60);
                $product = Cache::put('historyProducts'.$user, $historyProducts,$expiresAt);
      
                }
        } catch (\Exception $e) {
            Log::error('message: ' . $e->getMessage() . 'line: ' . $e->getLine() . 'file: ' . $e->getFile());
        }
    }
    public function store(Request $request)
    {
        try {
            if (isset(auth('api')->user()->id)) {
            $id = $request->id;
            $size = $request->size;
            $Name = $request->Name;
            $product = Product::with('sizes','category')->find($id);
                $user = auth('api')->user()->id;
                $carts = Cache::get('carts'.$user);
                if(isset($carts[$id][$size])){
                    $carts[$id][$size]['quantity'] +=  $request->quantity;
                    $carts[$id][$size]['price'] = $product->price;
                } else {
                $carts[$id][$size] = [
                    'id' => $id,
                    'quantity' => $request->quantity,
                    'name' => $product->name,
                    'size' => $Name,
                    'size_id' => $size,
                    'price' => $product->price,
                    'image' => $product->image,
                    'quantity_product' => $product->quantity,
                    'discount' => $product->discount,
                    'category' => $product->category->name,
                ];
            }
            $expiresAt = Carbon::now()->addDays(30);
            Cache::put('carts'.$user, $carts, $expiresAt);
            return response()->json([
                'status' => 200,
                'product' => $carts[$id][$size],
            ]);}
        } catch (\Exception $e) {
            Log::error('message: ' . $e->getMessage() . 'line: ' . $e->getLine() . 'file: ' . $e->getFile());
            return response()->json([
                'status' => 401,
                'message' => 'error',
            ]);
        }
    }
    public function remove(Request $request)
    {
        try { 
            $id = $request->id;
            $size = $request->size;
            if (isset(auth('api')->user()->id)) {
                $user = auth('api')->user()->id;
                $carts = Cache::get('carts'.$user);
                unset($carts[$id][$size]);
                if (empty($carts[$id])) {
                    unset($carts[$id]);
                }
                Cache::put('carts'.$user, $carts);
                return response()->json([
                    'status' => 200,
                    'message' => 'success',
                ]);
            }
        } catch (\Exception$e) {
            Log::error('message: ' . $e->getMessage() . 'line: ' . $e->getLine() . 'file: ' . $e->getFile());
            return response()->json([
                'status' => 401,
                'message' => 'error',
            ]);
        }
    }
    public function order(Request $request)
    {
        try{
            if (isset(auth('api')->user()->id)) {
            DB::beginTransaction();
            $user = auth('api')->user()->id;
            $order = new Order;
            $order->note = $request->note;
            $order->address = $request->address;
            $order->province_id = $request->province_id;
            $order->district_id = $request->district_id;
            $order->ward_id = $request->ward_id;
            $order->name_customer = $request->name_customer;
            $order->customer_id = $user;
            $order->phone = $request->phone;
            $order->total = 0;
            $order->save();
            $carts = Cache::get('carts'.$user);
            $order_total_price = 0;
            foreach ($carts as $productId => $cart) {
                $order_total_price += $cart['price'] * $cart['quantity'];
                OrderDetail::create([
                    'quantity' => $cart['quantity'],
                    'product_id' => $productId,
                    'total' => $cart['price'] * $cart['quantity'],
                    'order_id' => $order->id,
                ]);
                Product::where('id', $productId)->decrement('quantity', $cart['quantity']);
                
            }
            Cache::forget('carts'.$user);
            $order->total= $order_total_price;
            $order->save();
            DB::commit();
        }
            }catch(\Exception $e){
                DB::rollBack();
                Log::error('message: ' . $e->getMessage() . 'line: ' . $e->getLine() . 'file: ' . $e->getFile());
                return redirect()->route('shop.home');
            }

    }
    public function checkOuts(){
            $user = 1;
                $carts = Cache::get('carts'.$user);
                $provinces = Province::get();
                if ($carts) {
                    $carts = array_values($carts);
                    $params = [
                        'provinces' => $provinces,
                        'carts' => $carts,
                    ];
        return view('shop.checkout',$params);
    } else {
        return redirect()->route('shop.home');
    }
  
}   
    public function GetDistricts(Request $request)
    {
        $province_id = $request->province_id;
        $allDistricts = District::where('province_id', $province_id)->get();
        return response()->json($allDistricts);
    }
    public function getWards(Request $request)
    {
        $district_id = $request->district_id;
        $allWards = Ward::where('district_id', $district_id)->get();
        return response()->json($allWards);
    }




    public function getCartWishlist(){
        try {
        if (isset(auth('api')->user()->id)) {
            $user = auth('api')->user()->id;
            $cartsWishlist = Cache::get('cartsWishlist'.$user);
            if (isset($carts[$user])){
                $carts = array_values($carts);
            }
            } else {
                $carts = [];
            } 
            return response()->json([
                'cartsWishlist' => $cartsWishlist,
                'status' => 200
            ]);
        } catch (\Exception $e) {
            Log::error('message: ' . $e->getMessage() . ' line: ' . $e->getLine() . ' file: ' . $e->getFile());
            return response()->json([
                'status' => 401
            ]);
        }
    }
    

    public function storeWishlist(Request $request)
    {
        try {
            if (isset(auth('api')->user()->id)) {
            $id = $request->id;
            $size = $request->size;
            $Name = $request->Name;
            $product = Product::with('sizes','category')->find($id);
                $user = auth('api')->user()->id;
                $cartsWishlist = Cache::get('cartsWishlist'.$user);
                if(isset($cartsWishlist[$id][$size])){
                    $cartsWishlist[$id][$size]['quantity'] = 1;
                    $cartsWishlist[$id][$size]['price'] = $product->price;
                } else {
                $cartsWishlist[$id][$size] = [
                    'id' => $id,
                    'quantity' => $request->quantity,
                    'name' => $product->name,
                    'size' => $Name,
                    'size_id' => $size,
                    'price' => $product->price,
                    'image' => $product->image,
                    'quantity_product' => $product->quantity,
                    'discount' => $product->discount,
                    'category' => $product->category->name,
                ];
            }
            $expiresAt = Carbon::now()->addDays(30);
            Cache::put('cartsWishlist'.$user, $cartsWishlist, $expiresAt);
            return response()->json([
                'status' => 200,
                'product' => $cartsWishlist[$id][$size],
            ]);}
        } catch (\Exception $e) {
            Log::error('message: ' . $e->getMessage() . 'line: ' . $e->getLine() . 'file: ' . $e->getFile());
            return response()->json([
                'status' => 401,
                'message' => 'error',
            ]);
        }
    }
    public function removeWishlist(Request $request)
    {
        try { 
            $id = $request->id;
            $size = $request->size;
            if (isset(auth('api')->user()->id)) {
                $user = auth('api')->user()->id;
                $cartsWishlist = Cache::get('cartsWishlist'.$user);
                unset($cartsWishlist[$id][$size]);
                if (empty($cartsWishlist[$id])) {
                    unset($cartsWishlist[$id]);
                }
                Cache::put('cartsWishlist'.$user, $cartsWishlist);
                return response()->json([
                    'status' => 200,
                    'message' => 'success',
                ]);
            }
        } catch (\Exception$e) {
            Log::error('message: ' . $e->getMessage() . 'line: ' . $e->getLine() . 'file: ' . $e->getFile());
            return response()->json([
                'status' => 401,
                'message' => 'error',
            ]);
        }
    }






}
