@if (session()->has("success"))
    <div class="alert alert-success alert-dismissble fade show">
        <strong>{{session()->get("success")}}</strong>
        <button type="button" data-dismiss="alert" class="close">
            <span>&times;</span>
        </button>
    </div>
@endif