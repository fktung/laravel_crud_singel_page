<x-main menu='role'>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2 d-flex justify-content-between">
          <div class="col-sm-6">
            <h1 class="m-0">Role</h1>
          </div>
          
          <div class="col-sm d-flex flex-row-reverse bd-highlight">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
              Add Role
            </button>
          </div>
        </div>
      </div>
    </div>
    
    @if (session('massage'))
      <div id="massage" data-massage="{{ session('massage') }}"></div>
      @endif

    <section class="content">
      <div class="container-fluid">

        @if ($errors->any())
        <div class="alert alert-danger">
          @error('name')
            <div id="error" data-massage="{{$message}}"></div>
          @enderror
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif

        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Action</th>
              <th scope="col">nama</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($roles as $row)
            <tr>
              <th scope="row">{{ $loop->iteration }}</th>
              <td>
                <a href="#" class="badge bg-primary text-decoration-none">Edit</a>
                <a href="#" class="badge bg-info text-decoration-none">Detail</a>
              </td>
              <td>{{ $row->name }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>

      </div>
    </section>

  </div>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Role</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('role.store') }}" method="post">
          @csrf
          <div class="modal-body">
            <div class="form-group">
              <label for="name">Role Name</label>
              <input type="text" name="name" class="form-control" id="name" aria-describedby="roleHelp" placeholder="Role Name">
              @error('name')
              <div id="name" class="invalid-feedback">
                  {{ $message }}
              </div>
              @enderror
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  @push('script')
    <script>
      let massage = document.querySelector('#massage');
      let error = document.querySelector('#error');
      if (massage) {
          Swal.fire(
              massage.getAttribute("data-massage"),
              '',
              'success'
          )
      }
      if (error) {
          Swal.fire(
              error.getAttribute("data-massage"),
              '',
              'error'
          )
      }
    </script>
  @endpush

</x-main>