<?php

namespace App\Http\Controllers\Site;

use App\Models\Bank;
use App\Models\Money;
use App\Models\User;
use Illuminate\Http\Request;

class BankController
{



    function bank()
    {
        $banks = Bank::get();
        return view('bank.index', compact('banks'));
    }

    function formAddBank()
    {
        $users = User::select('name', 'id')->get();
        return view('bank.AddBank', compact('users'));
    }

    function AddBank(Request $request)
    {
        $request->validate([
            'amount' => 'required',
            'percentage' => 'required'
        ]);

        Bank::create([
            'user_id' => $request->user_id,
            'amount' => $request->amount,
            'percentage' => $request->percentage,
        ]);

        return redirect()->route('bank');
    }

    function money()
    {
        $bank_id = $_GET['bank_id'];
        $bank = Bank::findOrFail($_GET['bank_id']);
        $monies = Money::where('bank_id', $bank_id)->where('type', 'received')->get();
        return view('bank.money', compact('monies', 'bank'));
    }

    function formAddMoney()
    {
        return view('bank.AddMoney');
    }

    function addMoney(Request $request, $id)
    {

        $bank = Bank::findOrFail($id);
        $request->validate([
            'amount' => 'required'
        ]);

        if ($request->amount < $bank->residual) {
            Money::create([
                'bank_id' => $id,
                'amount' => $request->amount,
            ]);
        } else {
            return redirect()->back()->withErrors(
                [
                    'amount' => 'المبلغ الي دخل اكبر من المتبقي : ' . $bank->residual
                ]
            )->withInput();
        }




        return redirect()->route('money', ['bank_id' => $id]);
    }

    function formEditMoney(Request $request, $id)
    {
        $money = Money::findOrFail($id);
        return view('bank.EditMoney', compact('money'));
    }

    function editMoney(Request $request, $id)
    {
        $money = Money::findOrFail($id);
        $money->update([
            'amount' => $request->amount
        ]);

        return redirect()->route('money', ['bank_id' => $_GET['bank_id']]);
    }
}
