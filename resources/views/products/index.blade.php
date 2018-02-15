@extends('app')

@section('content')

<div class="container">

    <h1>Products</h1>
    <a href="{{ route('products.create') }}" class="btn btn-primary">Add new product</a>

    <table class="table">
             <thead>
               <tr>
                 <th>ID</th>
                 <th>Nome</th>
                 <th>Category</th>
                 <th>Price</th>
                 <th>Action</th>
               </tr>
             </thead>
             <tbody>
             @foreach($products as $product)
                     <tr>
                       <td>{{ $product->id  }}</td>
                       <td>{{ $product->name  }}</td>
                       <td>{{ $product->category->name }}</td>
                       <td>{{ $product->price  }}</td>
                       <td>
                           <a href="{{ route('products.destroy', ['id' => $product->id]) }}">Delete</a>
                           <a href="{{ route('products.edit', ['id' => $product->id]) }}">Edit</a>
                           <a href="{{ route('products.images', ['id' => $product->id]) }}">Image</a>

                       </td>
                     </tr>
             @endforeach
             </tbody>

        </table>

        <div class="text-center">
            {!! $products->render() !!}
        </div>



</div>

@endsection