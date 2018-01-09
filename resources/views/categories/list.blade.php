
<!-- @if(Session::has('ok'))
	<script>alert('Thành công')</script>
	<?php
		//Session::forget('ok');
	?>

@elseif(Session::has('fail'))
	<script>alert('Thất bại')</script>
	<?php
		//Session::forget('fail');
	?>
@endelse

@elseif(Session::has('none'))
	<script>alert('Đã có sản phẩm thuộc loại này')</script>
	<?php
		//Session::forget('none');
	?>
@endelse
@endif -->


@extends('include.layout')
@section('title', 'Products')


@section('content')
<section id="main-content">
  <section class="wrapper">
    <div class="table-agile-info">
 <div class="panel panel-default">
    <div class="panel-heading">
     List of Categories
    </div>
    <div>
      @foreach (['danger', 'warning', 'success', 'info'] as $msg)
          @if(Session::has('alert-' . $msg))
          <h4 class="alert alert-{{ $msg }}">{{ Session::get('alert-'.$msg) }}<button class="close" data-dismiss="alert" aria-label="close">&times;</button></h4>
          
          @endif
      @endforeach
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
            <th>Name</th>
          </tr>
        </thead>
        <tbody>
          @foreach($cates as $s)
          <tr data-expanded="true">
            <td>{{ $s->id }}</td>
            <td>{{ $s->name}}</td>
            
            
            <td>
              <a href="{!! route('categories.edit',$s->id) !!}" title="Edit" >
              <img src="{{ asset('/public/images/icons/pencil.png') }}" alt="Edit" />
            </a> 
            <a onclick="return Xoasanpham()" href="{!! route('categories.delete',$s->id) !!}" title="Edit" >
              <img src="{{ asset('/public/images/icons/cross.png') }}" alt="Edit" />
            </a> 
            <a href="{!! route('categories.list_pro',$s->id) !!}" title="Edit" >
              <img src="{{ asset('/public/images/icons/search.png') }}" alt="Edit" />
            </a> 

            </td>
          </tr>
         @endforeach

        </tbody>
      </table>
     
     {{ $cates->links() }}
    
    </div>
  </div>
</div>
</section>

@endsection