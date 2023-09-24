<div class="top-search">
    <div class="container">
        <form action="{{ route('shop.index') }}">
            <div class="input-group">
                <button type="submit" class="input-group-addon" id="pointer"><i class="fa fa-search"></i></button>
                <input type="text" class="form-control" placeholder="Search" name="search" value="{{ request('search') }}">
                <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
            </div>
        </form>
    </div>
</div>