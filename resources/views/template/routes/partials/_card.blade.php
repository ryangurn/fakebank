<div class="card">
    <div class="card-header">
        <div class="float-left">Routes for {{ $template->bank->name }}</div>

        <div class="float-right">
            <a href="{{ route('route.create', $template->id) }}" class="oi oi-plus" data-toggle="tooltip" title="Add Route"></a>
        </div>
    </div>


    <div class="card-body">
        <table class="table table-condensed">
            <thead>
            <tr>
                <th>Route</th>
                <th>File</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @if(isset($template->routes) && !$template->routes->isEmpty())
                @foreach($template->routes as $route)
                    <tr>
                        <td>{{ $route->route }}</td>
                        <td>{{ $route->file->storage  }}</td>
                        <td>
                            <a href="{{ route('route.show', $route->id) }}" class="badge-pill badge-primary" data-toggle="tooltip" title="Show Route">[Show]</a>
                            <a href="{{ route('route.edit', $route->id) }}" class="badge-pill badge-warning" data-toggle="tooltip" title="Edit Route">[Edit]</a>
                            <a href="#" class="badge-pill badge-danger" data-backdrop="true" data-toggle="modal" data-target="#activity_route_{{ $route->id }}" data-toggle="tooltip" title="Activity Log">[Logs]</a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="3">{{ __('None Configured') }}</td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
</div>
