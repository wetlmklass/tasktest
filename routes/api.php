<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\BalanceResource;
use App\Http\Resources\TransactionResource;
use App\Models\Balance;
use App\Models\Transaction;
use Illuminate\Support\Facades\Validator;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Метод изменения баланса
// curl -X POST http://localhost/api/balance -H 'Content-Type: application/json' -d '{"id": "2", "sum": "100"}'
Route::post('/balance', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'id' => 'required|integer|exists:balances,id',
        'sum' => 'required|numeric|min:0',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    $id = $request->input('id');
    $sum = $request->input('sum');

    $balance = Balance::find($id);

    $balance->sum = $sum;
    $balance->validate();
    $balance->save();

    return response()->json(['message' => 'Balance updated successfully'], 200);
});

// Метод запроса баланса
// curl http://localhost/api/balance/2
Route::get('/balance/{id}', function ($id) {
    $validator = Validator::make(['id' => $id], [
        'id' => 'required|integer|exists:balances,id',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    return new BalanceResource(Balance::findOrFail($id));
});

// Метод получения статистики
// curl -X POST http://localhost/api/transactions -H 'Content-Type: application/json' -d '{"from": "1995-03-15 00:00:00", "to": "2000-08-07 00:00:00"}'
Route::post('/transactions', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'from' => 'required|date_format:Y-m-d H:i:s',
        'to' => 'required|date_format:Y-m-d H:i:s|after_or_equal:from',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    $from = $request->input('from');
    $to = $request->input('to');

    return TransactionResource::collection(
                Transaction::whereBetween('operation_date', [$from, $to])
                ->orderBy('date', 'desc')
                ->get()
            );
});
