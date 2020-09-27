<div class="card">
    <div class="card-header">
        <div class="float-left">Variables for {{ $template->bank->name }}</div>

        <div class="float-right">
            <a href="{{ route('variable.create', $template->id) }}" class="oi oi-plus" data-toggle="tooltip" title="Create Variable"></a>
        </div>
    </div>


    <div class="card-body">
        <table class="table table-condensed">
            <thead>
            <tr>
                <th>Variable</th>
                <th>Value</th>
                <th>Executable</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @if(isset($template->variables) && !$template->variables->isEmpty())
                @foreach($template->variables as $variable)
                    <tr>
                        <td>{{ $variable->variable  }}</td>
                        <td>{{ $variable->value  }}</td>
                        <td>
                            @if($variable->executable == "True")
                                <span class="badge badge-success"><i class="oi oi-check"></i> {{ $variable->executable  }}</span>
                            @elseif($variable->executable == "False")
                                <span class="badge badge-danger"><i class="oi oi-x"></i> {{ $variable->executable  }}</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('variable.show', $variable->id) }}" class="badge-pill badge-primary" data-toggle="tooltip" title="Show Variable">[Show]</a>
                            <a href="{{ route('variable.edit', $variable->id) }}" class="badge-pill badge-warning" data-toggle="tooltip" title="Edit Variable">[Edit]</a>
                            <a href="#" class="badge-pill badge-danger" data-backdrop="true" data-toggle="modal" data-target="#activity_variable_{{ $variable->id }}" data-toggle="tooltip" title="Activity Log">[Logs]</a>
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
