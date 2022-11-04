<x-main menu='product'>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2 d-flex justify-content-between">
          <div class="col-sm-6">
            <h1 class="m-0">Product</h1>
          </div>
          
          <div class="col-sm d-flex flex-row-reverse bd-highlight">
            {{-- <a href="{{ url('product/add') }}" class="btn btn-success">Add Product</a> --}}
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
              Add Product
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
              <th scope="col">Nama</th>
              <th scope="col">Price</th>
              <th scope="col">Stok</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($product as $row)
            <tr id="data-rows">
              <form action="{{ route('product.update', ['id'=>$row->id]) }}" method="post">
                @csrf
                @method('put')
                <th scope="row">{{ $loop->iteration }}</th>
                <td>
                  <button id="edit" type="button" class="btn badge bg-primary text-decoration-none mx-1">Edit</button>
                  <button id="delete" type="button" class="btn inline badge bg-danger text-decoration-none mx-1">Delete</button>
                  <button id="cancel" type="button" class="btn badge bg-secondary text-decoration-none mx-1" hidden>Cancel</button>
                  <button id="update" type="submit" class="btn inline badge bg-success text-decoration-none mx-1" hidden>Update</button>
                </td>
                <td><input value="{{ $row->name }}" type="text" name="name" readonly class="input-transparent" id="name"></td>
                <td><input value="{{ $row->price }}" type="text" name="price" readonly class="input-transparent" id="price"></td>
                <td><input value="{{ $row->stock }}" type="text" name="stock" readonly class="input-transparent" id="stock"></td>
              </form>
              <form action="{{ route('product.destroy', ['id'=>$row->id]) }}" method="post" id="ProductDelete">
                @csrf
                @method('delete')
                {{-- <button id="delete" type="submit" class="btn inline badge bg-danger text-decoration-none mx-1">Delete</button> --}}
              </form>
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
          <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('product.store') }}" method="post">
          @csrf
          <div class="modal-body">
            <div class="form-group">
              <label for="name">Product Name</label>
              <input type="text" name="name" class="form-control" id="name" aria-describedby="roleHelp" placeholder="Product Name">
              @error('name')
              <div id="name" class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>
            <div class="form-group">
              <label for="price">Price</label>
              <input type="number" name="price" class="form-control" id="price" aria-describedby="PriceHelp" placeholder="Price">
              @error('price')
              <div id="price" class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>
            <div class="form-group">
              <label for="stock">Stock</label>
              <input type="number" name="stock" class="form-control" id="stock" aria-describedby="stockHelp" placeholder="Stock">
              @error('stock')
              <div id="stock" class="invalid-feedback">
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
      
      function cancel() {
          document.querySelectorAll('#edit').forEach(row => {
              row.removeAttribute('hidden');
          });
          document.querySelectorAll('#delete').forEach(row => {
              row.removeAttribute('hidden');
          });
          document.querySelectorAll('#cancel').forEach(row => {
              row.setAttribute('hidden', true);
          });
          document.querySelectorAll('#update').forEach(row => {
              row.setAttribute('hidden', true);
          });
          document.querySelectorAll('#name').forEach(row => {
              row.classList.add('input-transparent');
          });
          document.querySelectorAll('#price').forEach(row => {
              row.classList.add('input-transparent');
          });
          document.querySelectorAll('#stock').forEach(row => {
              row.classList.add('input-transparent');
          });
          document.querySelectorAll('#name').forEach(row => {
              row.setAttribute('readonly', true);
          });
          document.querySelectorAll('#price').forEach(row => {
              row.setAttribute('readonly', true);
          });
          document.querySelectorAll('#stock').forEach(row => {
              row.setAttribute('readonly', true);
          });
      }

      const dataRows = document.querySelectorAll('#data-rows');
      dataRows.forEach(row => {
          row.querySelector('#edit').addEventListener('click', () => {
              cancel();
              row.querySelector('#edit').setAttribute('hidden', true)
              row.querySelector('#delete').setAttribute('hidden', true)
              row.querySelector('#cancel').removeAttribute('hidden')
              row.querySelector('#update').removeAttribute('hidden')
              row.querySelector('#name').classList.remove('input-transparent');
              row.querySelector('#price').classList.remove('input-transparent');
              row.querySelector('#stock').classList.remove('input-transparent');
              row.querySelector('#name').removeAttribute('readonly');
              row.querySelector('#price').removeAttribute('readonly');
              row.querySelector('#stock').removeAttribute('readonly');
          })
          row.querySelector('#cancel').addEventListener('click', () => {
              cancel();
          })
          row.querySelector('#delete').addEventListener('click', () => {
              const hapus = confirm('apakah anda yakin?');
              if (hapus) {
                  row.querySelector('#ProductDelete').submit();
                  cancel();
              }
          })
      });
    </script>
  @endpush

</x-main>