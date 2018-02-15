@extends('app')

@section('content')

<div class="container">

    <h1>Categories</h1>
    <a href="{{ route('categories.create') }}" class="btn btn-primary">Add new category</a>

    <table class="table">
             <thead>
               <tr>
                 <th>ID</th>
                 <th>Nome</th>
                 <th>Action</th>
               </tr>
             </thead>
             <tbody>
             @foreach($categories as $category)
                     <tr>
                       <td>{{ $category->id  }}</td>
                       <td>{{ $category->name  }}</td>
                       <td>
                           <a href="{{ route('categories.destroy', ['id' => $category->id]) }}">Delete</a>
                           <a href="{{ route('categories.edit', ['id' => $category->id]) }}">Edit</a>

                       </td>
                     </tr>
             @endforeach
             </tbody>

        </table>

        <div class="text-center">
            {!! $categories->render() !!}
        </div>

</div>

@endsection