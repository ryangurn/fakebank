@if(isset($variables, $variables['form']))
    <form @if(isset($variables['form']['method'])) method="{{  $variables['form']['method'] }}" @endif @if(isset($variables['form']['action'])) action="{{  $variables['form']['action'] }}" @endif>
        @if(isset($variables['form']['hidden']) && $variables['form']['hidden'] == 'PUT')
            <input type="hidden" name="_method" value="PUT" />
        @endif
        {{ csrf_field()  }}
        <div class="form-group">
            <label for="name">Bank</label>

            @if(isset($banks) && !$banks->isEmpty())
            <select class="form-control" name="bank_id">
                @foreach($banks as $bank)
                    <option value="{{ $bank->id  }}">{{ $bank->name  }}</option>
                @endforeach
            </select>
            @else
            <div class="alert alert-warning">Banks not configured yet.</div>
            @endif
        </div>
        <div class="form-group">
            <label for="resource">Resource Path</label>
            <input type="text" id="resource" name="resource" class="form-control" placeholder="Bank Resource" @if(isset($bank) && $bank->resource != null) value="{{ $bank->resource  }}" @endif />
        </div>

        <div class="form-group">
            <label for="name">Settings</label>
            <textarea name="settings" class="form-control" placeholder="Settings for template, this must be in JSON form.">@if(isset($bank) && $bank->settings != null){{ json_encode($bank->settings)  }}@endif</textarea>
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

