@extends('Backend_Template') @section('mainContent')
<div class="container-fluid px-4">
    <h1 class="mt-4">Tables</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
        <li class="breadcrumb-item active">City</li>
    </ol>
    <div class="card mb-4" id="addNewForm">
        <div class="card-header">Add New City</div>
        <div class="card-body">
            <form action="{{ route('city.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="city" class="form-label">Name</label>
                    <input
                        type="text"
                        name="city"
                        class="form-control"
                        id="city"
                    />
                    <input
                        type="submit"
                        class="btn btn-primary mt-2 float-end"
                        value="Add Now"
                        placeholder="add now!"
                    />
                </div>
            </form>
        </div>
    </div>
    <div class="card mb-4 d-none" id="editForm">
        <div class="card-header">Edit City</div>
        <div class="card-body">
            <form method="post" id="editFormSubmit">
                @csrf @method('PATCH')
                <div class="mb-3">
                    <label for="ecity" class="form-label">Name</label>
                    <input
                        type="text"
                        name="ecity"
                        class="form-control"
                        id="ecity"
                    />
                    <input
                        type="submit"
                        class="btn btn-primary mt-2 float-end"
                        value="Add Now"
                        placeholder="add now!"
                    />
                </div>
            </form>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header mytable-card-header">
            <span>
                <i class="fas fa-table me-1"></i>
                DataTable Example
            </span>
            <!-- <a href="#staticBackdrop" class="nav-link" data-bs-toggle="modal"
                >New City</a
            > -->
        </div>
        <div class="card-body table-responsive">
            <table class="table " id="datatablesSimple">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @php $i=1; @endphp @foreach($cities as $city)

                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$city->name}}</td>
                        <td>
                            <button
                                class="btn btn-warning btn-edit"
                                data-id="{{$city->id}}"
                                data-name="{{$city->name}}"
                            >
                                Edit
                            </button>
                            <form
                                style="display: inline"
                                method="POST"
                                action="{{ route('city.destroy',$city->id) }}"
                            >
                                @csrf @method('delete')

                                <button type="submit" class="btn btn-danger">
                                    {{ __("Delete") }}
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection @section('script')
<script>
    $(document).ready(function () {
        $(".btn-edit").click(function (e) {
            let id = $(this).data("id");
            let name = $(this).data("name");
            $("#addNewForm").addClass("d-none");
            $("#editForm").removeClass("d-none");
            $('#editForm input[name="ecity"]').val(name);
            let url = "{{route('city.update',':id')}}";
            url = url.replace(":id", id);
            $("#editFormSubmit").attr("action", url);
        });
    });
</script>
@endsection
