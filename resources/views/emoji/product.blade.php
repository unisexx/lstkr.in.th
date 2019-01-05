@extends('layouts.front')

@section('content')

<div class="fh5co-narrow-content">

	<div class="d-flex animate-box" data-animate-effect="fadeInLeft">

		<div class="sticker-image-cover">
			<img class="img-fluid" src="https://stickershop.line-scdn.net/sticonshop/v1/product/{{ $rs->emoji_code }}/iphone/main.png" alt="สติ๊กเกอร์ไลน์ {{ $rs->title_th }}">
		</div>

		<div class="sticker-infomation">
			<h3>{{ $rs->title }}</h3>
			<ul>
				<li>ราคา : {{ $rs->price }} บาท</li>
				<li>ประเภท : {{ $rs->category }}</li>
				<li>ประเทศ : {{ $rs->country }}</li>
			</ul>
		</div>
		
	</div>

	<div class="text-center animate-box" data-animate-effect="fadeInLeft">
		<hr>
			<a href="http://line.me/ti/p/~ratasak1234" target="_blank"><button type="button" class="btn btn-success">สั่งซื้อคลิก</button></a>
			<a href="line://shop/emoji/detail?id={{ $rs->emoji_code }}" target="_blank"><button type="button" class="btn btn-secondary">ดูตัวอย่างในแอพไลน์</button></a>
		<hr>
	</div>

	@if($rs->detail) <p class="sticker-detail animate-box" data-animate-effect="fadeInLeft">{{ $rs->detail }}</p> @endif

	<div class="animate-box" data-animate-effect="fadeInLeft">

		@for($x = 1; $x <= 50; $x++)
			<img class="img-emoji" src="https://stickershop.line-scdn.net/sticonshop/v1/sticon/{{ $rs->emoji_code }}/iphone/{{ sprintf('%03d', $x) }}.png" alt="อิโมจิไลน์ {{ $rs->title }}" onerror="this.style.display='none'"/>
		@endfor
	</div>
		
</div>

@endsection
