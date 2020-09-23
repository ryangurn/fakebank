@if(isset($variables, $variables['form']))
    <form @if(isset($variables['form']['method'])) enctype="multipart/form-data" method="{{  $variables['form']['method'] }}" @endif @if(isset($variables['form']['action'])) action="{{  $variables['form']['action'] }}" @endif>
        @if(isset($variables['form']['hidden']) && $variables['form']['hidden'] == 'PUT')
            <input type="hidden" name="_method" value="PUT" />
        @endif
        {{ csrf_field()  }}
        <div class="form-group">
            <label for="purpose">File Purpose</label>
            <select name="purpose" id="purpose" class="form-control">
               <option value="0">Layouts</option>
               <option value="1">Partials</option>
               <option value="2">Modals</option>
            </select>
        </div>

        <div class="form-group">
            <label for="file">File</label>
            <input name="file" type="file" class="form-control-file" id="file">
        </div>

        <div class="form-group">
            @if(!isset($variables['form']['hidden']))
                <input type="submit" class="form-control btn btn-primary" value="Upload" />
            @else
                <input type="submit" class="form-control btn btn-primary" value="Update" />
            @endif
        </div>
    </form>
@endif

