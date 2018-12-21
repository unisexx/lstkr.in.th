@extends('layouts.front') @section('content')
<div class="row">
	<!-- /.col -->
	<div class="col-md-12">
        <h2>{{ $rs->title }}</h2>
        <div>
            {!! $rs->description !!}
        </div>
	</div>
	<!-- /.col -->
</div>
@endsection