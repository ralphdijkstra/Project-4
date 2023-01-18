<form action="{{ route('products.destroy', ['product' => $product->id]) }}" method="post">
    @csrf
    @method('DELETE')
    <div class="form-group">
        <label for="">Are you sure you want to delete {{ $product->name }}?</label>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-danger" value="Delete">
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
    </div>
</form>