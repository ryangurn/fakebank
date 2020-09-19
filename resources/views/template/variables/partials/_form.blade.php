@if(isset($variables, $variables['form']))
    <form @if(isset($variables['form']['method'])) method="{{  $variables['form']['method'] }}" @endif @if(isset($variables['form']['action'])) action="{{  $variables['form']['action'] }}" @endif>
        @if(isset($variables['form']['hidden']) && $variables['form']['hidden'] == 'PUT')
            <input type="hidden" name="_method" value="PUT" />
        @endif
        {{ csrf_field()  }}
        <div class="form-group">
            <label for="variable">Variable</label>
            <input type="text" id="variable" name="variable" class="form-control" placeholder="Variable" @if(isset($variable) && $variable->variable != null) value="{{ $variable->variable  }}" @endif />
        </div>

        <div class="form-group">
            <label for="value">Value</label>
            <textarea name="value" class="form-control" placeholder="Value to be substituted in the templates">@if(isset($variable) && $variable->value != null){{ $variable->value  }}@endif</textarea>
        </div>

        <div class="form-group">
            <button type="button" class="btn btn-primary" data-toggle="button" aria-pressed="false" autocomplete="off">
                Executable?
            </button>
            <small class="form-text text-muted">This will avoid being converted to html safe text if toggled on.</small>
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

