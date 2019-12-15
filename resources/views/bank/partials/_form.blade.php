@if(isset($variables, $variables['form']))
<form @if(isset($variables['form']['method'])) method="{{  $variables['form']['method'] }}" @endif @if(isset($variables['form']['action'])) action="{{  $variables['form']['action'] }}" @endif>
    @if(isset($variables['form']['hidden']) && $variables['form']['hidden'] == 'PUT')
        <input type="hidden" name="_method" value="PUT" />
    @endif
    {{ csrf_field()  }}
    <div class="form-group">
        <label for="name">Bank Name</label>
        <input type="text" id="name" name="name" class="form-control" placeholder="Bank Name" @if(isset($bank) && $bank->name != null) value="{{ $bank->name  }}" @endif />
    </div>
    <div class="form-group">
        <label for="caption">Bank Caption</label>
        <input type="text" id="caption" name="caption" class="form-control" placeholder="Bank Caption" @if(isset($bank) && $bank->caption != null) value="{{ $bank->caption  }}" @endif />
    </div>

    <div class="form-group">
        <label for="name">Trolls</label>
        <textarea name="trolls" class="form-control" placeholder="Trolls to enable, this must be in JSON form.">@if(isset($bank) && $bank->trolls != null){{ $bank->trolls  }}@endif</textarea>
    </div>

    <div class="form-group">
        @if(!isset($variables['form']['hidden']) && $variables['form']['hidden'] != 'PUT')
        <input type="submit" class="form-control btn btn-primary" value="Create" />
        @else
        <input type="submit" class="form-control btn btn-primary" value="Update" />
        @endif
    </div>
</form>
@endif
