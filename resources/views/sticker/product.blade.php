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

	@if($rs->detail) <p class="sticker-detail animate-box" data-animate-effect="fadeInLeft">{{ $rs->detail }}</p> @endif

	<div class="animate-box" data-animate-effect="fadeInLeft">
		<img class="img-fluid" src="https://sdl-stickershop.line.naver.jp/products/0/0/{{ $rs->version }}/{{ $rs->sticker_code }}/LINEStorePC/preview.png" alt="สติ๊กเกอร์ไลน์ {{ $rs->title_th }}">
	</div>
		
</div>

@endsection
