@props(['title'=>'Add Client'])
<div class="modal fade" id="clientModal" tabindex="-1">
    <div class="modal-dialog">
        <form id="clientForm">
            @csrf
            <input type="hidden" name="id" id="client_id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="clientModalTitle">{{$title}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3"><label>Name</label><input type="text" name="name" class="form-control" required></div>
                    <div class="mb-3"><label>Email</label><input type="email" name="email" class="form-control"></div>
                    <div class="mb-3"><label>Mobile</label><input type="text" name="mobile" class="form-control"></div>
                    <div class="mb-3"><label>Address</label><textarea name="address" class="form-control"></textarea></div>
                    <div class="mb-3"><label>TAX Number</label><input type="text" name="gst_number" class="form-control"></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>
