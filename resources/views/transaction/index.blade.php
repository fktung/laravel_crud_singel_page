<x-main menu='transaction'>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2 d-flex justify-content-between">
          <div class="col-sm-6">
            <h1 class="m-0">Transaction</h1>
          </div>
          
          <div class="col-sm d-flex flex-row-reverse bd-highlight">
            <a href="{{ url('transaction/add') }}" class="btn btn-success">Add Transaction</a>
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
              <th scope="col">Kode</th>
              <th scope="col">Product</th>
              <th scope="col">Quantity</th>
              <th scope="col">Total</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($transaction as $row)
            <tr>
              <th scope="row">{{ $loop->iteration }}</th>
              <td class="d-flex">
                <a href="{{ url('/transaction', [$row->kode]) }}" class="btn badge bg-primary text-decoration-none mx-1">Edit</a>
                {{-- <a href="{{ url('/transaction/detail', [$row->kode]) }}" class="btn badge bg-secondary text-decoration-none mx-1">Detail</a> --}}
                {{-- <form action="{{ route('transaction.destroy', ['id'=>$row->id]) }}" method="post">
                  <button type="submit" class="btn inline badge bg-danger text-decoration-none mx-1">Delete</button>
                </form> --}}
              </td>
              <td>{{ $row->kode }}</td>
              <td>
                @foreach ($products as $product)
                  @if($row->productId === $product->id)
                    {{ $product->name }}
                  @endif
                @endforeach
              </td>
              <td>{{ $row->quantity }}</td>
              <td>{{ $row->total }}</td>
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
          <h5 class="modal-title" id="exampleModalLabel">Add Transaction</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('role.store') }}" method="post">
          @csrf
          <div class="modal-body">
            <div class="form-group">
              <label for="name">Role Name</label>
              <input type="name" name="name" class="form-control" id="name" aria-describedby="roleHelp" placeholder="Role Name">
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