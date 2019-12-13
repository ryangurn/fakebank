@if(isset($variables, $variables['form']))
<form @if(isset($variables['form']['method'])) method="{{  $variables['form']['method'] }}" @endif @if(isset($variables['form']['action'])) action="{{  $variables['form']['action'] }}" @endif>
    {{ csrf_field()  }}
    <div class="form-group">
        <label for="name">Bank Name</label>
        <input type="text" id="name" name="name" class="form-control" placeholder="Bank Name" />
    </div>
    <div class="form-group">
        <label for="caption">Bank Caption</label>
        <input type="text" id="caption" name="caption" class="form-control" placeholder="Bank Caption" />
    </div>

    <div class="form-group">
        <label for="name">Trolls</label>
        <textarea name="trolls" class="form-control" placeholder="Trolls to enable, this must be in JSON form."></textarea>
    </div>

    <div class="form-group">
        <input type="submit" class="form-control btn btn-primary" value="Create" />
    </div>
</form>
@endif
