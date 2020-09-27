<div class="card">
    <div class="card-header">
        <div class="float-left">Files for {{ $template->bank->name }}</div>

        <div class="float-right">
            <a href="{{ route('file.create', $template->id) }}" class="oi oi-cloud-upload" data-toggle="tooltip" title="Upload File"></a>
        </div>
    </div>


    <div class="card-body">
        <table class="table table-condensed">
            <thead>
            <tr>
                <th>File</th>
                <th>Purpose</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @if(isset($template->files) && !$template->files->isEmpty())
                @foreach($template->files as $file)
                    <tr>
                        <td>{{ $file->storage  }}</td>
                        <td>{{ $file->type  }}</td>
                        <td>
                            <a href="{{ route('file.show', $file->id) }}" class="badge-pill badge-primary" data-toggle="tooltip" title="Show File">[Show]</a>
                            <a href="{{ route('file.edit', $file->id) }}" class="badge-pill badge-warning" data-toggle="tooltip" title="Edit File">[Edit]</a>
                            <a href="#" class="badge-pill badge-danger" data-backdrop="true" data-toggle="modal" data-target="#activity_file_{{ $file->id }}" data-toggle="tooltip" title="Activity Log">[Logs]</a>
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
