<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Examination;
use App\Models\ListPrice;
use App\Models\Specialty;
use Exception;
use Illuminate\Http\Request;

class ListPriceController extends Controller
{
    public function index(Request $request)
    {
        $title = trans('main.list_prices');
        $prices = ListPrice::when($request->search, function ($q) use ($request) {
            return $q->where('price', 'LIKE', '%' . $request->search . '%');
        })->latest()->paginate(10);
        $specialties = Specialty::all();
        $examinations = Examination::all();
        return view('dashboard.list_prices.index', compact('title', 'prices', 'specialties', 'examinations'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        /**
         *  add "prices_list.*." before column name if you use array to add more than 1 filed .
         */
        $rules = [
            'prices_list.*.specialty_id' => 'required',
            'prices_list.*.examination_id' => 'required',
            'prices_list.*.price' => 'required',
        ];
        $validate = $this->validate($request, $rules);

        $prices = $request->prices_list;

        try {

            /**
             * this foreach use when add more than 1 Price in one form .
             */
            foreach ($prices as $price) {
                ListPrice::create([
                    'specialty_id' => $price['specialty_id'],
                    'examination_id' => $price['examination_id'],
                    'price' => $price['price'],
                ]);
            }

            toastr()->success(trans('main.data_added_successfully'));
            return back();
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    public function show(ListPrice $listPrice)
    {
        //
    }

    public function edit(ListPrice $listPrice)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'specialty_id' => 'required',
            'examination_id' => 'required',
            'price' => 'required',
        ];
        $validate = $this->validate($request, $rules);

        $price = ListPrice::findOrFail($id);

        try {

            $price->update([
                'specialty_id' => $request->specialty_id,
                'examination_id' => $request->examination_id,
                'price' => $request->price,
            ]);

            toastr()->success(trans('main.data_updated_successfully'));
            return back();

        } catch (Exception $e) {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        ListPrice::findOrFail($id)->delete();
        toastr()->success(trans('main.data_deleted_successfully'));
        return back();
    }
}
