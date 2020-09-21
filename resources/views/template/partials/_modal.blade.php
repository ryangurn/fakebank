@if(!$templates->isEmpty())
    @foreach($templates as $template)
<div class="modal" id="activity_template_{{ $template->id }}" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Template Activity Log</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="accordion" id="template_accordion">
                    @if(isset($template->activities) && !$template->activities->isEmpty())
                        @foreach($template->activities as $activity)
                            @if($activity->subject_id == $template->id)
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#activity_{{ $activity->id }}" aria-expanded="true" aria-controls="collapseOne">
                                    <span class="float-left">
                                        <b>{{ $activity->causer->name }}</b> {{ $activity->description }} template for bank <b>{{ $activity->subject->bank->name }}</b>
                                    </span>
                                    <span class="float-right">
                                        <span class="badge badge-primary">{{ $activity->created_at->diffForHumans()  }}</span>
                                    </span>
                                </button>
                            </h2>
                        </div>

                        <div id="activity_{{ $activity->id }}" class="collapse" aria-labelledby="headingOne" data-parent="#template_accordion">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2"><span class="badge badge-primary">Log</span></div>
                                    <div class="col-md-10">{{ $activity->log_name }}</div>
                                </div>
                                @if(isset(json_decode($activity->changes())->attributes) && json_decode($activity->changes())->attributes != null)
                                <div class="row">
                                    <div class="col-md-2"><span class="badge badge-danger">New Data</span></div>
                                    <div class="col-md-10">{{ json_encode(json_decode($activity->changes())->attributes) }}</div>
                                </div>
                                @endif
                                @if(isset(json_decode($activity->changes())->old) && json_decode($activity->changes())->old != null)
                                <div class="row">
                                    <div class="col-md-2"><span class="badge badge-warning">Prior Data</span></div>
                                    <div class="col-md-10">{{ json_encode(json_decode($activity->changes())->old) }}</div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
    @endforeach
@endif
