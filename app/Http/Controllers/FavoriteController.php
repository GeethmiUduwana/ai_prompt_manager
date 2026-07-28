<?php

namespace App\Http\Controllers;


use App\Models\Favorite;
use Illuminate\Http\Request;


class FavoriteController extends Controller
{


    public function store($id)
    {


        Favorite::create([

            'user_id'=>auth()->id(),

            'prompt_id'=>$id

        ]);



        return back()->with('success', 'Added to favorites!');


    }




    public function destroy($id)
    {


        Favorite::where('prompt_id',$id)
            ->where('user_id',auth()->id())
            ->delete();



        return back()->with('success', 'Removed from favorites!');


    }



    public function index()
    {


        $favorites = Favorite::with('prompt')
            ->where('user_id',auth()->id())
            ->get();



        return view(
            'favorites.index',
            compact('favorites')
        );


    }


}