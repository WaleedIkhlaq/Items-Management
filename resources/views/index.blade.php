<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <link rel="icon" href="{{ asset('img/favicon.png') }}" sizes="16x16">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<!-- HEADER SECTION CONTAINING LOGO AND TITLE -->
<section id="header">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title">
                    <h1 class="text-center">{{ $title }}</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- HEADER ENDS -->

<!-- FORM SECTION CONTAINING FORM -->
<section id="form">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="input-form">
                    @include('errors.response')
                    <form method="post" action="/add_items">
                        {{ csrf_field () }}
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-9">
                                    <input type="text" name="title" class="form-control" required="required" placeholder="Item name" value="{{ old('title') }}" autofocus="autofocus">
                                </div>
                                <div class="col-md-3">
                                    <button class="btn btn-primary btn-block" type="submit">Add</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- FORM ENDS -->

<!-- ITEMS SECTION CONTAINING LISTS & SELECTED LISTS -->
<section id="items">
    <div class="container">
        <div class="row">

            <form method="post" action="/upsert_items">
                {{ csrf_field () }}
                <input type="hidden" name="action" value="upsert-selected">
                <div class="row">
                    <div class="col-md-5">
                        <div class="items">
                            <ul>
                                @if(count ($items) > 0)
                                    @foreach($items as $item)
                                        <li class="item-{{ $item -> id }}">
                                            <input type="radio" name="item" id="item-{{ $item -> id }}"
                                                   value="{{ $item -> id }}"
                                                   onchange='checkIfChecked("item-{{ $item -> id }}")'>
                                            <label for="item-{{ $item -> id }}">
                                                {{ ucfirst ($item -> title) }}
                                            </label>
                                        </li>
                                    @endforeach
                                @else
                                    <li>
                                        <label>No selected added.</label>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="arrows">
                            @if(count ($items) > 0 or count ($selectedItems) > 0)
                            <button class="right-arrow" type="submit">
                                <i class="fa fa-chevron-right"></i>
                            </button>
                            <button class="left-arrow" type="submit">
                                <i class="fa fa-chevron-left"></i>
                            </button>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="selected-items">
                            <div class="items">
                                <ul>
                                    @if(count ($selectedItems) > 0)
                                        @foreach($selectedItems as $selectedItem)
                                            <li class="item-{{ $selectedItem -> id }}">
                                                <input type="radio" name="item" id="item-{{ $selectedItem -> id }}"
                                                       value="{{ $selectedItem -> id }}"
                                                       onchange='checkIfChecked("item-{{ $selectedItem -> id }}")'>
                                                <label for="item-{{ $selectedItem -> id }}">
                                                    {{ ucfirst ($selectedItem -> title) }}
                                                </label>
                                            </li>
                                        @endforeach
                                    @else
                                        <li>
                                            <label>No selected item(s) found.</label>
                                        </li>
                                    @endif

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</section>
<!-- ITEMS ENDS -->


</body>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" href="{{ asset('js/bootstrap.min.js') }}"></script>
<script type="text/javascript">
    function checkIfChecked ( id ) {
        jQuery ( '.items li' ).removeClass ( 'selected' );
        if ( jQuery ( '#' + id ).is ( ":checked" ) )
            jQuery ( '.' + id ).toggleClass ( 'selected' );
    }
</script>
</html>