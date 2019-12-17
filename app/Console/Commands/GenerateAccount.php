<?php

namespace App\Console\Commands;

use App\Account;
use App\Bank;
use Faker\Factory;
use Illuminate\Console\Command;

class GenerateAccount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:account';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Account within fakebank';

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
        $banks = Bank::all();

        $data = [];
        foreach($banks as $bank){
            $data[$bank->id]['bank'] = $bank->id;
            $data[$bank->id]['name'] = $bank->name;
        }
        $headers = ['bank', 'name'];
        $this->table($headers, $data);

        // bank info
        $bank = $this->ask('Which bank do you want to add an account to? (provide integer): ');
        $bankValidator = validator(['bank_id' => $bank], ['bank_id' => 'required|exists:banks,id|integer']);
        if($bankValidator->fails()){
            $this->error("Invalid Bank Provided");
            exit();
        }

        // type info
        $type = $this->ask("Saving(0)/Checking(1)/Credit(2)? (provide integer) ", 0);
        $typeValidator = validator(['type' => $type], ['type' => 'required|in:0,1,2|integer']);
        if($typeValidator->fails()){
            $this->error("Invalid Bank Account Type Provided, Please select saving/checking/credit");
            exit();
        }

        // balance info
        $balance = $this->ask("Overall Balance? (provide float): ", 800.01);
        $balanceValidator = validator(['balance' => $balance], ['balance' => 'required|numeric']);
        if($balanceValidator->fails()){
            $this->error("Invalid Balance Amount Provided");
            exit();
        }



        // generate account
        $faker = Factory::create();
        $account = Account::create([
            'bank_id' => $bank,
            'type' => $type,
            'number' => $faker->bankAccountNumber,
            'balance' => $balance,
            'settings' => ['enabled' => true]
        ]);

        // provide output
        $this->alert($account->type." Created with Number(".$account->number.") with balance(".$balance.")");
    }
}
