<?php

namespace App\Http\Controllers;

use App\Models\city;
use App\Models\review;
use App\Rules\CityExist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class MainController extends Controller
{
    public function show(Request $request)
    {
        $citys = city::orderBy('name', 'asc')->get();
        return view('index', ['citys' => $citys]);
    }

    public function welcome()
    {
        $city = session('city');
        if ($city) {
            return redirect()->route('reviews_name', $city);
        }
        return view('welcome');
    }

    public function reviews()
    {

        $reviews = review::inRandomOrder()->get();
        return view('reviews', ['reviews' => $reviews]);
    }

    public function reviews_city($name)
    {

        $cityId = city::where('name', $name)->first();
        if ($cityId) {
            session()->put('city', $name);
            $city = review::where('city_id', $cityId->id)->orWhere('city_id', null)->get();

            return view('reviews', ['reviews' => $city, 'cityId' => $cityId]);
        } else {
            return abort(404);
        }


    }

    public function session(Request $request)
    {
        $request->session()->put('city', $request->city);
        return redirect()->route('reviews_name', $request->city);
    }

    public function addreview()
    {
        return view('addreview');
    }

    public function storeReview(Request $request)
    {
        $validation = $request->validate(
            [
                'title' => 'required',
                'text' => 'required|max:255',
                'city' => ['nullable', 'string'],//new CityExist
                'rating' => 'required|numeric',
                'file' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000'
            ]
        );

        $validation['author_id'] = Auth::user()->id;
        if ($request->has('city') && !is_null($request->city)) {
            if (!city::where('name', $validation['city'])->first()) {
                $city = city::create(['name' => $validation['city']]);
            }
            $city = city::where('name', $validation['city'])->first();
            $validation['city_id'] = $city->id;
            unset($validation['city']);
            if ($request->has('file')) {
                $validation['img'] = $request->file('file')->store('public');
                review::create($validation);
            } else {
                review::create($validation);
            }
        } elseif ($request->has('file')) {
            $validation['img'] = $request->file('file')->store('public');
            review::create($validation);
        } else {
            review::create($validation);
        }

        return redirect()->route('index')->with('success','Отзыв успешно создан');
    }

    public function edit($id)
    {
        $review = review::find($id);
        if($review->city_id){
            $city = city::find($review->city_id);
        }else{
            $city = null;
        }

        return view('addreview', ['review' => $review, 'city' => $city]);
    }

    public function update(Request $request, $id)
    {
        $validation = $request->validate(
            [
                'title' => 'required',
                'text' => 'required|max:255',
                'city' => ['nullable', 'string'],//new CityExist
                'rating' => 'required|numeric',
                'file' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000'
            ]
        );

        $review = review::find($id);
        if ($request->has('file') && !is_null($review->img)) {
            Storage::delete($review->img);
            $validation['img'] = $request->file('file')->store('public');
        }elseif($request->has('file')){
            $validation['img'] = $request->file('file')->store('public');
        }
//        if(is_null($request->input('file')) && !is_null($review->img)){
//            Storage::delete($review->img);
//            $validation['img'] = null;
//        }

        if ($request->input('city') && city::where('name', $validation['city'])->first()) {
            $city = city::where('name', $validation['city'])->first();
            $validation['city_id'] = $city->id;
            $review->update($validation);
        } elseif(!is_null($request->input('city'))) {
            $city = city::create(['name' => $validation['city']]);
            $validation['city_id'] = $city->id;
            $review->update($validation);
        }
        if(is_null($request->input('city'))){
            $validation['city_id']= null;
            $review->update($validation);
        }
       return back()->with('success','Отзыв успешно изменен');
    }
    public function destroy($id){
            review::destroy($id);
            return back()->with('success','Отзыв успешно удален');
    }

}
