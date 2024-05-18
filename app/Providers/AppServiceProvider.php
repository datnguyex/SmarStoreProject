<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\CustomerUser;
use App\Models\Product;
use App\Models\Category;
use App\Models\Seller;
use App\Models\Comment;
use App\Models\Cart;
use App\Models\Cart_detail;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('header', function ($view) {
            
            if(session()->has('email')) {
                $email = session('email');
                $customerUser = CustomerUser::where('email', $email)->first();
                $cart = Cart::where('user_id', $customerUser->id)->first();
                $count_cart = Cart_detail::where('cart_id', $cart->id)->count();
                $view->with([
                    'customerUser'=> $customerUser,
                    'number' => $count_cart,
                ]);

            }
        });
        
        View::composer('auth.account.header', function ($view) {
            if(session()->has('email')) {
                $email = session('email');
                $customerUser = CustomerUser::where('email', $email)->first();
                $cart = Cart::where('user_id', $customerUser->id)->first();
                $count_cart = Cart_detail::where('cart_id', $cart->id)->count();
                $view->with([
                    'customerUser'=> $customerUser,
                    'number' => $count_cart,
                ]);
            }
        });

        View::composer('header_store', function ($view) {
            if(session()->has('email')) {
                $email = session('email');
                $customerUser = CustomerUser::where('email', $email)->first();
                $cart = Cart::where('user_id', $customerUser->id)->first();
                $count_cart = Cart_detail::where('cart_id', $cart->id)->count();
                $view->with([
                    'customerUser'=> $customerUser,
                    'number' => $count_cart,
                ]);
            }
        });

        View::composer('header_cart', function ($view) {
            if(session()->has('email')) {
                $email = session('email');
                $customerUser = CustomerUser::where('email', $email)->first();
                $cart = Cart::where('user_id', $customerUser->id)->first();
                $count_cart = Cart_detail::where('cart_id', $cart->id)->count();
                $view->with([
                    'customerUser'=> $customerUser,
                    'number' => $count_cart,
                ]);
            }
        });
    }
}
