@extends('app')

@section('content')

    <div class="container">
        <h1>Create Image</h1>

        {!! Form::open(['route' => ['products.images.store', 'id' => $product->id], 'enctype' => 'multipart/form-data']) !!}

        @if($errors->any())

            <ul class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        @endif

        <div class="form-group">
            {!! Form::label('image', 'Image:') !!}
            {!! Form::file('image', null, ['class' => 'form-control']) !!}
        </div>

        <div class="row">
            <div class="col-md-4">
                {!! Form::submit('Add Image', ['class' => 'btn btn-primary form-control']) !!}
            </div>
            <div class="col-md-4">
                <a href="{{ route('products') }}" class="btn btn-warning">Voltar</a>
            </div>
        </div>

        {!! Form::close() !!}

    </div>

@endsection