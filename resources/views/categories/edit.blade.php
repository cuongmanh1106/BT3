
@if(Session::has('ok'))
	<script>alert('Thành công')</script>
	<?php
		Session::forget('ok');
	?>

@elseif(Session::has('fail'))
	<script>alert('Thành công')</script>
	<?php
		Session::forget('fail');
	?>
@endelse

@endif

@extends('include.layout')
@section('title', 'Products')


@section('content')
 <section id="main-content">
    <section class="wrapper">
        <div class="form-w3layouts">
            <!-- page start-->
            
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Insert Product
                            <span class="tools pull-right">
                                <a class="fa fa-chevron-down" href="javascript:;"></a>
                                <a class="fa fa-cog" href="javascript:;"></a>
                                <a class="fa fa-times" href="javascript:;"></a>
                             </span>
                        </header>
                        <div class="panel-body">
                            <div class=" form">
                                @if (count($errors) > 0)
                                <ul>
                                  @foreach($errors->all() as $err)
                                    <li style="color: red">{{ $err }}</li>
                                    <!--<script type="text/javascript">alert('{!! $err !!}')</script>-->
                                  @endforeach
                                </ul>
                                @endif
                                <form method="POST" class="cmxform form-horizontal " id="commentForm"  action="{{ route('categories.update',$cate->id)}}" novalidate="novalidate">
                                    {{ csrf_field() }}
                                    <div class="form-group ">
                                        <label for="cname" class="control-label col-lg-3">Name (required)</label>
                                        <div class="col-lg-6">
                                            <input class=" form-control" value="{{ $cate->name }}" id="cname" name="name" minlength="2" type="text" required="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-offset-3 col-lg-6">
                                            <button class="btn btn-primary" type="submit">Save</button>
                                            <input class="btn btn-default" type="button" value="Bỏ qua" onclick="window.location='{{ route('categories.list') }}'" />
                                        </div>
                                    </div>
                                </form>

                            </div>

                        </div>
                    </section>
                </div>
            </div>
            
            <!-- page end-->
        </div>
</section>
@endsection
