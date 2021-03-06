<?php

namespace App\Http\Controllers;

use App\Services\Currency;
use App\Services\CurrencyPresenter;
use App\Services\CurrencyRepositoryInterface;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    private $repository;

    function __construct(CurrencyRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $currencies = $this->repository->findAll();
        $outputData = array_map(function (Currency $currency) {
            return CurrencyPresenter::present($currency);
        }, $currencies);
        return $outputData;
    }

    public function show(int $id)
    {
        $currency = $this->repository->findById($id);
        if ($currency !== null) {
            return response()->json(CurrencyPresenter::present($currency));
        } else {
            return response()->json("Currency with id = ${id} doesn't exist", 404);
        }
    }

    public function store(Request $request)
    {
        //get max id from currency array
        $currencies = $this->repository->findAll();
        $maxId = end($currencies)->getId();

        $data = $request->post();
        $currency = new Currency(++$maxId, $data['name'], $data['short_name'], $data['actual_course'],
            $data['actual_course_date'], $data['active']);
//        $currency = app(Currency::class, ['id' => ++$maxId, 'name' =>
//            $data['name'], 'short_name' => $data['short_name'], 'actual_course' =>
//            $data['actual_course'], 'actual_course_date' =>
//            $data['actual_course_date'], 'active' => $data['active']]);
        $this->repository->save($currency);
        return response()->json($data);
    }

    public function update(Request $request, int $id)
    {
        $currency = $this->repository->findById($id);
        if ($currency !== null) {
            $currency = CurrencyPresenter::present($currency);
            $data = $request->all();
            $currency = array_merge($currency, $data);
            $currency = new Currency($currency['id'], $currency['name'], $currency['short_name'], $currency['actual_course'],
                $currency['actual_course_date'], $currency['active']);
//            $currency = app(Currency::class, ['id' => $currency['id'], 'name' =>
//                $currency['name'], 'short_name' => $currency['short_name'], 'actual_course' =>
//                $currency['actual_course'], 'actual_course_date' =>
//                $currency['actual_course_date'], 'active' => $currency['active']]);
            $this->repository->save($currency);
            return response()->json(CurrencyPresenter::present($currency));
        } else {
            return response()->json("Currency with id = ${id} doesn't exist", 404);
        }
    }

    public function destroy(int $id)
    {
        $currency = $this->repository->findById($id);
        if ($currency !== null) {
            $this->repository->delete($currency);
            return response('Currency was removed!');
        } else {
            return response()->json("Currency with id = ${id} doesn't exist", 404);
        }
    }

    public function showCurrencies()
    {
        $currencies = $this->repository->findAll();
        return view('render_currencies', ['currencies' => $currencies]);
    }
}