@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('message'))
    <div class="alert alert-success" style="border-radius: 0">
        {{ session('message') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger" style="border-radius: 0">
        {{ session('error') }}
    </div>
@endif

<style>
    .alert li, .alert {
        text-align: left;
    }
    .alert ul, .alert li {
        margin-bottom: 0;
    }
    .alert ul {
        padding-left: 15px;
    }
</style>