<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CartRepositoryInterface;


class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $cartRepository;

    public function __construct(CartRepositoryInterface $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }
    public function index()
    {
        
        $cartItems = $this->cartRepository->getCartItemsForUser(auth()->id());

        return view('cart.index',compact('cartItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      
        try{
        $this->cartRepository->create([
            'user_id' => auth()->id(),
            'product_id' => $request->product_id,
        ]);
        $cartItemCount=$this->cartRepository->getCartItemsCountForUser(auth()->id());
        return response()->json(['success' => true, 'message' => 'Product added to cart successfully!','cartCount'=>$cartItemCount]);
        }catch(\Exception $e){
            dd($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $cartItem = $this->cartRepository->find($id);            
            if ($cartItem) {
                $cartItem->update([
                    'quantity' => $request->quantity
                ]);    
                return response()->json(['success' => true,'Message'=>'Cart Updated']);
            }
    
           
        } catch (\Exception $e) {
            
            return response()->json(['error' => 'An error occurred while updating the cart.'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cartItem = $this->cartRepository->find($id);

        if ($cartItem) {
            $this->cartRepository->delete($id);
            return response()->json(['success' => true]);
        }

    }
}
