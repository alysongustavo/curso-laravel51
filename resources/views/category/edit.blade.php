@extends('app')

@section('content')

    <div class="container">
        <h1>Edit Category : {{ $category->name }}</h1>

        {!! Form::open(['route' => ['categories.update',$category->id], 'method' => 'put']) !!}

        @if($errors->any())

            <ul class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        @endif

        <div class="form-group">
            {!! Form::label('name', 'Name:') !!}
            {!! Form::text('name', $category->name, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('description', 'Description:') !!}
            {!! Form::textarea('description', $category->description, ['class' => 'form-control']) !!}
        </div>

        <div class="row">
            <div class="col-md-4">
                {!! Form::submit('Save Category', ['class' => 'btn btn-primary form-control']) !!}
            </div>
            <div class="col-md-4">
                <a href="{{ route('categories') }}" class="btn btn-warning">Voltar</a>
            </div>
        </div>

        {!! Form::close() !!}

    </div>

@endsection