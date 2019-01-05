@extends('layouts.front')

@section('content')

<div class="fh5co-narrow-content">

	<div class="d-flex animate-box" data-animate-effect="fadeInLeft">

		<div class="sticker-image-cover">
			<img class="img-fluid" src="https://sdl-stickershop.line.naver.jp/products/0/0/{{ $rs->version }}/{{ $rs->sticker_code }}/LINEStorePC/main.png" alt="สติ๊กเกอร์ไลน์ {{ $rs->title_th }}">
		</div>

		<div class="sticker-infomation">
			<h3>{{ $rs->title_th }}</h3>
			<ul>
				<li>ราคา : {{ convert_line_coin_2_money($rs->price) }} บาท</li>
				<li>ประเภท : {{ $rs->category }}</li>
				<li>ประเทศ : {{ $rs->country }}</li>
			</ul>
		</div>
		
	</div>

	<div class="text-center animate-box" data-animate-effect="fadeInLeft">
		<hr>
			<a href="http://line.me/ti/p/~ratasak1234" target="_blank"><button type="button" class="btn btn-success">สั่งซื้อคลิก</button></a>
			<a href="line://shop/sticker/detail?id={{ $rs->sticker_code }}" target="_blank"><button type="button" class="btn btn-secondary">ดูตัวอย่างในแอพไลน์</button></a>
		<hr>
	</div>

	@if($rs->detail) <p class="sticker-detail animate-box" data-animate-effect="fadeInLeft">{{ $rs->detail }}</p> @endif

	<div class="animate-box" data-animate-effect="fadeInLeft">
		<img class="img-fluid" src="https://sdl-stickershop.line.naver.jp/products/0/0/{{ $rs->version }}/{{ $rs->sticker_code }}/LINEStorePC/preview.png" alt="สติ๊กเกอร์ไลน์ {{ $rs->title_th }}">
	</div>
		
</div>

@endsection
