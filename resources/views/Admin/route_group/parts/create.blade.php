<link href="{{asset('assets/admin')}}/plugins/select2/select2.min.css" rel="stylesheet"/>
<div class="modal-header">
    <h5 class="modal-title" id="example-Modal3">Add new activity for group</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form id="addForm" class="addForm" method="POST" enctype="multipart/form-data" action="{{route('routes.store')}}" >
    @csrf


        <div class="form-group">
            <label class="form-label">Choose group</label>
            <select name="group_id" class="form-control select2" data-placeholder="Choose Group">
                @foreach($groups as $group)
                    <option value="{{$group->id}}">{{$group->title}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label class="form-label">Choose activity</label>
            <select name="activity_id" class="form-control select2" data-placeholder="Choose Activity">
                @foreach($activities as $activity)
                    <option value="{{$activity->id}}">{{$activity->title}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="name" class="form-control-label">Time of group in activity</label>
            <input type="time" class="form-control" name="time_group" id="time_group">
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="addButton">Create</button>
        </div>
    </form>
</div>

<script>
    $('.dropify').dropify()
</script>
<script src="{{asset('assets/admin')}}/js/select2.js"></script>
<script src="{{asset('assets/admin')}}/plugins/select2/select2.full.min.js"></script>
