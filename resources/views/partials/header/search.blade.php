<div class="col-sm-6 offset-sm-2 offset-md-0 col-lg-4">
    <div class="search-bar row bg-light p-2 rounded-4">
        <form id="search-form" action="{{ route('products.search') }}" method="GET" class="d-flex align-items-center w-100">

            <div class="col-md-4 d-none d-md-block">
                <select name="category" class="form-select border-0 bg-transparent">
                    <option value="">All Categories</option>
                    <option value="groceries">Groceries</option>
                    <option value="drinks">Drinks</option>
                    <option value="chocolates">Chocolates</option>
                </select>
            </div>

            <div class="col-8 col-md-6">
                <input type="text" name="q" class="form-control border-0 bg-transparent" 
                       placeholder="Search for more than 20,000 products"
                       value="{{ request('q') }}">
            </div>

            <div class="col-2 col-md-2 text-end">
                <button type="submit" class="btn btn-link p-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M21.71 20.29L18 16.61A9 9 0 1 0 16.61 18l3.68 3.68a1 1 0 0 0 1.42 0a1 1 0 0 0 0-1.39ZM11 18a7 7 0 1 1 7-7a7 7 0 0 1-7 7Z"/>
                    </svg>
                </button>
            </div>
        </form>
    </div>
</div>
