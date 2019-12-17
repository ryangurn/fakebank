<?php

namespace App\Console\Commands;

use App\Account;
use App\Bank;
use App\Transaction;
use Illuminate\Console\Command;

class GenerateTransaction extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:transaction';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a transaction for a specific account.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $accounts = Account::all();

        $data = [];
        foreach($accounts as $account){
            $data[$account->id]['account'] = $account->id;
            $data[$account->id]['bank'] = $account->bank->name;
            $data[$account->id]['type'] = $account->type;
            $data[$account->id]['number'] = $account->number;
        }
        $headers = ['account', 'bank', 'type', 'number'];
        $this->table($headers, $data);

        // bank info
        $acct = $this->ask('Which account do you want to add a transaction to? (provide integer): ');
        $acctValidator = validator(['account_id' => $acct], ['account_id' => 'required|exists:accounts,id|integer']);
        if($acctValidator->fails()){
            $this->error("Invalid account Provided");
            exit();
        }

        $description = $this->ask('Description for the transaction? (provide string): ', 'APL*iTUNES.COM/BILL');
        $descriptionValidator = validator(['description' => $description], ['description' => 'required|min:2|max:255|string']);
        if($descriptionValidator->fails()){
            $this->error("Invalid description provided");
            exit();
        }

        $amount = $this->ask("Amount for the transaction? (provide float): ", 0.99);
        $amountValidator = validator(['amount' => $amount], ['amount' => 'required|numeric']);
        if($amountValidator->fails()){
            $this->error("Invalid amount provided");
            exit();
        }

        $transaction = Transaction::create([
            'account_id' => $acct,
            'description' => $description,
            'amount' => $amount
        ]);

        $this->alert("Transaction created on account(".$transaction->account->number.") with description(".$transaction->description.") and amount(".$transaction->amount.")");
    }
}
