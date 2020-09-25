@if(isset($variables, $variables['form']))
    <form @if(isset($variables['form']['method'])) enctype="multipart/form-data" method="{{  $variables['form']['method'] }}" @endif @if(isset($variables['form']['action'])) action="{{  $variables['form']['action'] }}" @endif>
        @if(isset($variables['form']['hidden']) && $variables['form']['hidden'] == 'PUT')
            <input type="hidden" name="_method" value="PUT" />
        @endif
        {{ csrf_field()  }}
        <div class="form-group">
            <label for="purpose">File Purpose</label>
            <select name="purpose" id="purpose" class="form-control">
               <option value="0" @if(isset($file) && $file->type == "Layout")selected="selected"@endif>Layouts</option>
               <option value="1" @if(isset($file) && $file->type == "Partial")selected="selected"@endif>Partials</option>
               <option value="2" @if(isset($file) && $file->type == "Modal")selected="selected"@endif>Modals</option>
            </select>
        </div>

        <div class="form-group">
            <label for="file">File</label>
            @if(!isset($file) && $file->storage == "")
            <input name="file" type="file" class="form-control-file" id="file">
            @else
               <p><u>{{ 'resources/views/public/'.$file->template->resource.'/'.strtolower($file->type).'s/'.$file->storage }}</u></p>
            @endif
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

