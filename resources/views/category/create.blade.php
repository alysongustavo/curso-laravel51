@extends('app')

@section('content')

    <div class="container">
        <h1>Create Category</h1>

        {!! Form::open(['route' => 'categories.store']) !!}

        @if($errors->any())

            <ul class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        @endif

        <div class="form-group">
            {!! Form::label('name', 'Name:') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('description', 'Description:') !!}
            {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
        </div>

        <div class="row">
            <div class="col-md-4">
                {!! Form::submit('Add Category', ['class' => 'btn btn-primary form-control']) !!}
            </div>
            <div class="col-md-4">
                <a href="{{ route('categories') }}" class="btn btn-warning">Voltar</a>
            </div>
        </div>

        {!! Form::close() !!}

    </div>

@endsection