@extends('customer.layouts.app')
<link rel="stylesheet" href="{{ asset('theme/website/common/cart.css') }}">
@section('content')
    <div class="container m-5">
        <div class="divTable div-hover">

            <div class="rowTable bg-dark text-white pb-2">
                <div class="divTableCol">Product</div>
                <div class="divTableCol">Quantity</div>
                <div class="divTableCol">Price</div>
                <div class="divTableCol">Total</div>
                <div class="divTableCol">Actions</div>
            </div>
            @php
                $total = 0;
            @endphp
            @foreach ($cartItems as $item)
                <div class="rowTable" data-product-id="{{ $item->id }}">
                    <div class="divTableCol">
                        <div class="media">
                            <a class=" pull-left mr-2 ml-0" href="#">
                                <img class="img-fluid" src="{{ asset('storage/' . $item->product->image) }}" />
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading"><a href="#">{{ $item->product->name }}</a></h4>
                                <span>Status: </span><span class="text-warning"><strong>{{ $item->status }}</strong></span>
                            </div>
                        </div>
                    </div>
                    <div class="divTableCol">
                        <input type="number" class="form-control quantity" value="{{ $item->quantity }}" min="1" />
                    </div>
                    <div class="divTableCol item-total" data-price="{{ $item->product->price }}">
                        RS:{{ $item->product->price }}
                    </div>
                    <div class="divTableCol"><strong
                            class="item-total">RS:{{ $item->product->price * $item->quantity }}</strong></div>
                    <div class="divTableCol">
                        <button type="button" class="btn btn-danger remove-item"><span class="fa fa-remove"></span>
                            Remove</button>
                    </div>
                </div>
                @php
                    $total += $item->product->price * $item->quantity;
                @endphp
            @endforeach

            <div class="rowTable">
                <div class="divTableCol"></div>
                <div class="divTableCol"></div>
                <div class="divTableCol"></div>
                <div class="divTableCol">
                    <h5>Subtotal</h5>
                </div>
                <div class="divTableCol">
                    <h5><strong id="subtotal">{{ number_format($total, 2) }}</strong></h5>
                </div>
            </div>
            <div class="rowTable">
                <div class="divTableCol"></div>
                <div class="divTableCol"></div>
                <div class="divTableCol"></div>
                <div class="divTableCol">
                    <h5>Total</h5>
                </div>
                <div class="divTableCol">
                    <h5><strong id="total">{{ number_format($total, 2) }}</strong></h5>
                </div>
            </div>

            <div class="rowTable">
                <div class="divTableCol"></div>
                <div class="divTableCol"></div>
                <div class="divTableCol"></div>
                <div class="divTableCol"></div>
                <div class="divTableCol">
                    <button type="button" class="btn btn-success">CheckOut</span></button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('.quantity').on('change', function() {
                let quantity = $(this).val();
                let row = $(this).closest('.rowTable');
                let productId = row.data('product-id');
                let price = parseFloat(row.find('.item-total').data('price'));

                if (isNaN(price)) {
                    console.error('Price is NaN. Check the data-price attribute.');
                    return;
                }

                $.ajax({
                    url: "{{ route('cart.update', ['id' => ':id']) }}".replace(':id', productId),
                    type: 'PATCH',
                    data: {
                        quantity: quantity,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        let newTotal = price * quantity;
                        row.find('.item-total').text('RS:' + newTotal.toFixed(2));
                        let subtotal = 0;
                        $('.item-total').each(function() {
                            subtotal += parseFloat($(this).text().replace('RS:', ''));
                        });
                        $('#subtotal').text(subtotal.toFixed(2));
                        $('#total').text(subtotal.toFixed(2));
                    },
                    error: function(xhr, status, error) {
                        alert('An error occurred while updating the quantity.');
                    }
                });
            });
            $('.remove-item').on('click', function() {
        let row = $(this).closest('.rowTable');
        let productId = row.data('product-id');

        $.ajax({
            url: "{{ route('cart.destroy', ['id' => ':id']) }}".replace(':id', productId),
            type: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                row.remove(); // Remove row from UI
                let subtotal = 0;
                $('.item-total').each(function() {
                    let itemTotal = parseFloat($(this).text().replace('RS:', ''));
                    if (!isNaN(itemTotal)) {
                        subtotal += itemTotal;
                    }
                });
                $('#subtotal').text(subtotal.toFixed(2));
                $('#total').text(subtotal.toFixed(2));
            },
            error: function(xhr, status, error) {
                alert('An error occurred while removing the item.');
            }
        });
    });
        });
    </script>
@endpush
