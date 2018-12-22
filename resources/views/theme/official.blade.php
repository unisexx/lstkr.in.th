@extends('layouts.front')

@section('content')

<div class="fh5co-narrow-content">
	<h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">ธีมไลน์ทางการ</h2>
	<div class="row animate-box d-flex flex-wrap justify-content-center" data-animate-effect="fadeInLeft">
		@foreach($theme as $row)
		<div class="work-item text-center">
			<a href="{{ url('theme/product/'.$row->id) }}">
				<img src="{{ $row->cover }}" alt="สติ๊กเกอร์ไลน์ {{ $row->title_th }}" class="img-fluid">
				<h3 class="fh5co-work-title">{{ $row->title }}</h3>
				<p>{{ ucfirst($row->category) }}, {{ $row->price }} บาท</p>
			</a>
		</div>
		@endforeach
		<div class="clearfix visible-md-block"></div>
		{{ $theme->appends(@$_GET)->render() }}
	</div>
</div>

@endsection
