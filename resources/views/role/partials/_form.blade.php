@if(isset($variables, $variables['form']))
<form @if(isset($variables['form']['method'])) method="{{  $variables['form']['method'] }}" @endif @if(isset($variables['form']['action'])) action="{{  $variables['form']['action'] }}" @endif>
    @if(isset($variables['form']['hidden']) && $variables['form']['hidden'] == 'PUT')
        <input type="hidden" name="_method" value="PUT" />
    @endif
    {{ csrf_field()  }}

    <div class="form-group">
        <label for="name">Name</label>
        <input id="name" class="form-control" name="name" placeholder="Name" @if(isset($role) && $role->name != null) value="{{ $role->name  }}" @endif />
    </div>

    <div class="form-group">
        <label for="name">Short Description</label>
        <input id="description" class="form-control" name="description" placeholder="Short Description" @if(isset($role->id) && \App\RoleMeta::where('role_id', '=', $role->id)->first()->description != null) value="{{ \App\RoleMeta::where('role_id', '=', $role->id)->first()->description  }}" @endif />
    </div>

    <div class="form-group">
        <label for="name">Long Description</label>
        <input id="long" class="form-control" name="long" placeholder="Long Description" @if(isset($role->id) && \App\RoleMeta::where('role_id', '=', $role->id)->first()->long != null) value="{{ \App\RoleMeta::where('role_id', '=', $role->id)->first()->long  }}" @endif />
    </div>

    <div class="form-group">
        <label for="permissions">Permissions</label>
        <select multiple="multiple" class="form-control" name="permissions[]">
            @if(isset($permissions) && !$permissions->isEmpty())
                @foreach($permissions as $permission)
            <option value="{{ $permission->id }}" @if(isset($role) && in_array($role->id, $permission->roles->pluck('id')->toArray())) selected="selected" @endif>{{ $permission->name }}</option>
                @endforeach
            @else
                <div class="alert alert-warning">Permissions not configured yet, contact a support representative.</div>
            @endif
        </select>
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
