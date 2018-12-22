@extends('layouts.front')

@section('content')

<div class="fh5co-narrow-content">
	<h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">อิโมจิไลน์ทางการ</h2>
	<div class="row animate-box d-flex flex-wrap justify-content-center" data-animate-effect="fadeInLeft">
		@foreach($emoji as $row)
		<div class="work-item text-center">
			<a href="{{ url('emoji/product/'.$row->emoji_code) }}">
				<img src="https://stickershop.line-scdn.net/sticonshop/v1/product/{{ $row->emoji_code }}/iphone/main.png" alt="สติ๊กเกอร์ไลน์ {{ $row->title }}" class="img-fluid">
				<h3 class="fh5co-work-title">{{ $row->title }}</h3>
				<p>{{ ucfirst($row->category) }}, {{ $row->price }} บาท</p>
			</a>
		</div>
		@endforeach
		<div class="clearfix visible-md-block"></div>
		{{ $emoji->appends(@$_GET)->render() }}
	</div>
</div>

@endsection
