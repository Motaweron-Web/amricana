<div class="modal-header">
    <h5 class="modal-title" id="example-Modal3">Edit Place</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form id="updateForm" method="POST" enctype="multipart/form-data" action="{{route('places.updatePlace')}}" >
        @csrf
        @method('PUT')



        <input type="hidden" name="id" value="{{$place->id}}"/>
        <div class="form-group">
            <label for="name" class="form-control-label">Title</label>
            <input type="text" class="form-control" name="title" id="title" value="{{$place->title}}">
        </div>
        <div class="form-group">
            <label for="email" class="form-control-label">Description</label>
            <input type="text" class="form-control" name="description" id="description" value="{{$place->description}}">
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success" id="updateButton">Update</button>
        </div>
    </form>

</div>
<script>
    $('.dropify').dropify()
</script>
<script src="{{asset('assets/admin')}}/js/select2.js"></script>
<script src="{{asset('assets/admin')}}/plugins/select2/select2.full.min.js"></script>
