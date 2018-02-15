@extends('app')

@section('content')

<div class="container">

    <h1>Product: {{ $product->name }}</h1>
    <a href="{{ route('products.images.create', ['id' => $product->id]) }}" class="btn btn-primary">Add new Image</a>

    <table class="table">
             <thead>
               <tr>
                 <th>ID</th>
                 <th>Image</th>
                 <th>Extension</th>
                 <th>Action</th>
               </tr>
             </thead>
             <tbody>
             @foreach($product->images as $image)
                     <tr>
                       <td>{{ $image->id  }}</td>
                       <td><img src="{{ url('/uploads/' . $image->id . '.' . $image->extension) }}" width="80"/></td>
                       <td>{{ $image->extension }}</td>
                       <td>
                           <a href="{{ route('products.images.destroy', ['id' => $image->id]) }}">Delete</a>
                       </td>
                     </tr>
             @endforeach
             </tbody>

        </table>

</div>

@endsection