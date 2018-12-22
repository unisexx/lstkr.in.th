@extends('layouts.front')

@section('content')

<div class="fh5co-narrow-content">

	<div class="d-flex justify-content-center animate-box" data-animate-effect="fadeInLeft">

		<div class="">
			<img class="img-fluid" src="https://stickershop.line-scdn.net/sticonshop/v1/product/{{ $rs->emoji_code }}/iphone/main.png" alt="สติ๊กเกอร์ไลน์ {{ $rs->title_th }}">
		</div>

		<div class="sticker-detail">
			<h3>{{ $rs->title }}</h3>
			<p>{{ $rs->detail }}</p>
			<ul>
				<li>ราคา : {{ $rs->price }} บาท</li>
				<li>ประเภท : {{ $rs->category }}</li>
				<li>ประเทศ : {{ $rs->country }}</li>
			</ul>
		</div>
	</div>

	<div class="d-flex flex-wrap justify-content-center animate-box" data-animate-effect="fadeInLeft">
		@for($x = 1; $x <= 50; $x++)
			<img width="120" height="120" src="https://stickershop.line-scdn.net/sticonshop/v1/sticon/{{ $rs->emoji_code }}/iphone/{{ sprintf('%03d', $x) }}.png" alt="อิโมจิไลน์ {{ $rs->title }}" onerror="this.style.display='none'"/>
		@endfor
	</div>
		
</div>

@endsection
