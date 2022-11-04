<x-main menu='transaction'>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Edit Transaction</h1>
          </div>

        </div>
      </div>
    </div>
    
    @if (session('error'))
      <div id="error" data-massage="{{ session('error') }}"></div>
    @endif

    <section class="content">
      <div class="container-fluid">

        <div class="row">
          <div class="col-md-8">

            {{-- <form action="{{ route('routeName', ['id'=>1]) }}" method="post"> --}}
            <form action="{{ route('transaction.update', ['kode' => $transaction->kode]) }}" method="post">
              @method('put')
              @csrf
              
              <input type="text" class="form-control" id="kode" name="kode" value="{{ $transaction->kode }}" hidden>
              <div class="mb-3 row">
                <label for="product" class="col-sm-2 col-form-label">Product</label>
                <div class="col-sm-10">
                  <select onchange="totalHarga()" id="harga-product" class="form-select @error('productId') is-invalid @enderror" id="product" name="productId">
                    <option value="">Select Produc</option>
                    @foreach ($products as $row)
                    @if ( $transaction->productId == $row->id )
                      <option selected data-harga="{{$row->price}}" value="{{$row->id}}">{{$row->name}} - stock = {{$row->stock}}</option>
                    @else
                      <option data-harga="{{$row->price}}" value="{{$row->id}}">{{$row->name}} - stock = {{$row->stock}}</option>
                    @endif
                    @endforeach
                  </select>
                  @error('productId')
                  <div id="productId" class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
              </div>
              <div class="mb-3 row">
                <label for="quantity" class="col-sm-2 col-form-label">Quantity</label>
                <div class="col-sm-10">
                  <input onchange="totalHarga()" type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" value="{{ $transaction->quantity }}" placeholder="Quantity">
                  @error('quantity')
                  <div id="quantity" class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
              </div>
              <div class="mb-3 row">
                <label for="total" class="col-sm-2 col-form-label">Total</label>
                <div class="col-sm-10">
                  <input type="number" class="form-control @error('total') is-invalid @enderror" id="total" readonly>
                </div>
              </div>
              <button type="submit" class="btn btn-success">Save</button>
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
      let hargaProduct = document.getElementById('harga-product');
      let quantity = document.getElementById('quantity');
      let total = document.getElementById('total');
      let harga = hargaProduct.options[hargaProduct.selectedIndex].getAttribute('data-harga');
      total.value = harga * quantity.value
      function totalHarga() {
        harga = hargaProduct.options[hargaProduct.selectedIndex].getAttribute('data-harga');
        total.value = harga * quantity.value
      }
    </script>
  @endpush

</x-main>