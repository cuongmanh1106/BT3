@extends('include.layout')
@section('title', 'Products')


@section('content')
<section id="main-content">
  <section class="wrapper">
    <div class="table-agile-info">
 <div class="panel panel-default">
    <div class="panel-heading">
     List of products
    </div>
    <div>
      <table class="table" ui-jq="footable" ui-options='{
        "paging": {
          "enabled": true
        },
        "filtering": {
          "enabled": true
        },
        "sorting": {
          "enabled": true
        }}'>
        <thead>
          <tr>
            <th data-breakpoints="xs">ID</th>
            <th>Name product</th>
            <th>Category</th>
            <th data-breakpoints="xs">Cost</th>
            <th data-breakpoints="xs sm md" data-title="DOB">Image</th>
          </tr>
        </thead>
        <tbody>
          @foreach($product as $s)
          <tr data-expanded="true">
            <td>{{ $s->id }}</td>
            <td>{{ $s->name}}</td>
            <td>{{ $s->cate_name}}</td>
            <td>{{ $s->cost}}</td>
            
            <td><img src="{{ asset('/public/images/')}}/{{$s->images}}" width="150px"></td>
            <td>
              <a href="{!! route('product.edit',$s->id) !!}" title="Edit" >
              <img src="{{ asset('/public/images/icons/pencil.png') }}" alt="Edit" />
            </a> 
            <a onclick="return Xoasanpham()" href="{!! route('product.delete',$s->id) !!}" title="Edit" >
              <img src="{{ asset('/public/images/icons/cross.png') }}" alt="Edit" />
            </a> 

            </td>
          </tr>
         @endforeach

        </tbody>
      </table>
      @if($search == '')
     {{ $product->links() }}
    @endif
    </div>
  </div>
</div>
</section>

@endsection