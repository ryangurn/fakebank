@if(isset($variables, $variables['form']))
    <form @if(isset($variables['form']['method'])) method="{{  $variables['form']['method'] }}" @endif @if(isset($variables['form']['action'])) action="{{  $variables['form']['action'] }}" @endif>
        @if(isset($variables['form']['hidden']) && $variables['form']['hidden'] == 'PUT')
            <input type="hidden" name="_method" value="PUT" />
        @endif
        {{ csrf_field()  }}
        <div class="form-group">
            <label for="name">Account</label>
            @if(isset($accounts) && !$accounts->isEmpty())
                <select name="account_id" class="form-control">
                    @foreach($accounts as $account)
                        <option @if(isset($transaction) && $transaction->account_id != null && $transaction->account_id == $account->id) selected="selected" @endif value="{{ $account->id  }}">[{{ $account->bank->name  }}] - {{ $account->number  }} - ({{$account->balance}})</option>
                    @endforeach
                </select>
            @else
                <div class="alert alert-warning">Accounts not configured yet.</div>
            @endif
        </div>
        <div class="form-group">
            <label for="caption">Description</label>
            <textarea name="description" class="form-control" placeholder="Transaction Description">@if(isset($transaction) && $transaction->description != null){{ $transaction->description  }}@endif</textarea>
        </div>

        <div class="form-group">
            <label for="name">Amount</label>
            <input type="text" name="amount" class="form-control" placeholder="Transaction Amount" @if(isset($transaction) && $transaction->amount != null)value="{{ $transaction->amount  }}"@endif />
        </div>

        <div class="form-group">
            @if(!isset($variables['form']['hidden']))
                <input type="submit" class="form-control btn btn-primary" value="Create" />
            @else
                <input type="submit" class="form-control btn btn-primary" value="Update" />
            @endif
        </div>
    </form>
@endif
