@if($errors->has('product_error'))
    <div class="error alert alert-warning">{{ $errors->first('product_error') }}</div>
@endif
