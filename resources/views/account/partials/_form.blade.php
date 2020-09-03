@if(isset($variables, $variables['form']))
    <form @if(isset($variables['form']['method'])) method="{{  $variables['form']['method'] }}" @endif @if(isset($variables['form']['action'])) action="{{  $variables['form']['action'] }}" @endif>
        @if(isset($variables['form']['hidden']) && $variables['form']['hidden'] == 'PUT')
            <input type="hidden" name="_method" value="PUT" />
        @endif
        {{ csrf_field()  }}
        <div class="form-group">
            <label for="name">Bank</label>
            @if(isset($banks) && !$banks->isEmpty())
                <select name="bank_id" class="form-control">
                    @foreach($banks as $bank)
                        <option @if(isset($account) && $account->bank_id != null && $account->bank_id == $bank->id) selected="selected" @endif value="{{ $bank->id  }}">{{ $bank->name  }}</option>
                    @endforeach
                </select>
            @else
                <div class="alert alert-warning">Banks not configured yet.</div>
            @endif
        </div>
        <div class="form-group">
            <label for="type">Type</label>
            <select name="type" class="form-control">
                <optgroup label="Standard">
                    <option @if(isset($account) && $account->type == "Saving") selected="selected" @endif value="0">Savings</option>
                    <option @if(isset($account) && $account->type == "Checking") selected="selected" @endif value="1">Checking</option>
                    <option @if(isset($account) && $account->type == "Credit Card") selected="selected" @endif value="2">Credit Card</option>
                </optgroup>
            </select>
        </div>

        <div class="form-group">
            <label for="number">Number</label>
            <input type="text" name="number" class="form-control" placeholder="Account Number" @if(isset($account) && $account->number != null)value="{{ $account->number  }}"@endif />
        </div>

        <div class="form-group">
            <label for="balance">Balance</label>
            <input type="text" name="balance" class="form-control" placeholder="Account Balance" @if(isset($account) && $account->balance != null)value="{{ substr($account->balance, 1)  }}"@endif />
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
