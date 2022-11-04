<x-main menu='user'>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Edit User</h1>
          </div>

        </div>
      </div>
    </div>
    
    @if (session('verifPassword'))
      <div id="error" data-massage="{{ session('verifPassword') }}"></div>
    @endif

    <section class="content">
      <div class="container-fluid">

        <div class="row">
          <div class="col-md-8">

            <form action="{{ route('user.update') }}" method="post">
              @method('put')
              @csrf
              
              <input type="text" class="form-control" id="id" name="id" value="{{ $user->id }}" hidden>
              <div class="mb-3 row">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $user->name }}" placeholder="Name">
                  @error('name')
                  <div id="name" class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
              </div>
              <div class="mb-3 row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                  <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $user->email }}" placeholder="Email">
                  @error('email')
                  <div id="email" class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
              </div>
              <div class="mb-3 row">
                <label for="password" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{ old('password') }}" placeholder="Password">
                  @error('password')
                  <div id="password" class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
              </div>
              <div class="mb-3 row">
                <label for="verifPassword" class="col-sm-2 col-form-label">Verifikasi Password</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control @error('verifPassword') is-invalid @enderror" id="verifPassword" name="verifPassword" value="{{ old('verifPassword') }}" placeholder="Verifikasi Password">
                  @error('verifPassword')
                  <div id="verifPassword" class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
              </div>
              <div class="mb-3 row">
                <label for="role" class="col-sm-2 col-form-label">Role</label>
                <div class="col-sm-10">
                  <select class="form-select @error('roleId') is-invalid @enderror" id="role" name="roleId">
                    <option value="">Select Role</option>
                    @foreach ($roles as $row)
                    @if($row->id === $user->roleId)
                      <option selected value="{{$row->id}}">{{$row->name}}</option>
                    @else
                      <option value="{{$row->id}}">{{$row->name}}</option>
                    @endif
                    @endforeach
                  </select>
                  @error('roleId')
                  <div id="roleId" class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
              </div>
              <button type="submit" class="btn btn-primary">Update</button>
            </form>

          </div>
        </div>


      </div>
    </section>

  </div>

  @push('script')
    <script>
      let error = document.querySelector('#error');
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