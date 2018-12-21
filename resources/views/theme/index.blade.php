@extends('layouts.front')

@section('content')

<div class="row">
	<div class="col-md-12">
		<div class="box box-default">
			<div class="box-header with-border">
			<h2 class="box-title">ธีมไลน์</h2>
			<!-- /.box-tools -->
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			@foreach($theme as $row)
				<div class="col-xs-4 col-sm-3 col-md-2">
					<div class="panel panel-default">
						<div class="panel-body">
						<a href="{{ url('theme/'.$row->slug) }}">
							<div><img class="img-responsive" src="https://shop.line-scdn.net/themeshop/v1/products/{{ $row->theme_path }}/WEBSTORE/icon_136x190.png"></div>
							<h3>{{ $row->name }}</h3>
						</a>
						</div>
					</div>
				</div>
			@endforeach
			</div>
			<!-- /.box-body -->
			<div class="box-footer text-center">
				{{ $theme->appends(@$_GET)->render() }}
			</div>
			<!-- /.box-footer -->
		</div>
		<!-- /.box -->
	</div>
</div>

@endsection
