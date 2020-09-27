@if(isset($variables, $variables['form']))
    <form @if(isset($variables['form']['method'])) method="{{  $variables['form']['method'] }}" @endif @if(isset($variables['form']['action'])) action="{{  $variables['form']['action'] }}" @endif>
        @if(isset($variables['form']['hidden']) && $variables['form']['hidden'] == 'PUT')
            <input type="hidden" name="_method" value="PUT" />
        @endif
        {{ csrf_field()  }}
        <div class="form-group">
            <label for="variable">File</label>
            @if(isset($template->files) && !$template->files->isEmpty())
                <select name="file_id" class="form-control">
                    @foreach($template->files as $file)
                        <option @if(isset($route) && $route->file_id != null && $route->file_id == $file->id) selected="selected" @endif value="{{ $file->id  }}">{{ $file->storage  }}</option>
                    @endforeach
                </select>
            @else
                <div class="alert alert-warning">No files for this template, yet.</div>
            @endif
        </div>

        <div class="form-group">
            <label for="route">Route</label>
            <input name="route" class="form-control" placeholder="Route slug" @if(isset($route) && $route->route != null) value="{{ $route->route  }}" @endif />
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

