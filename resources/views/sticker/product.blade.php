@extends('layouts.front')

@section('content')

<div class="fh5co-narrow-content">

	<div class="d-flex animate-box" data-animate-effect="fadeInLeft">

		<div class="sticker-image-cover">
			<img class="img-fluid playAnimate" src="{{ get_sticker_img_url($rs->stickerresourcetype,$rs->version,$rs->sticker_code) }}" alt="สติ๊กเกอร์ไลน์ {{ $rs->title_th }}" data-animation="{{ get_sticker_img_url($rs->stickerresourcetype,$rs->version,$rs->sticker_code) }}">
			<audio preload="metadata">
				<source src="https://sdl-stickershop.line.naver.jp/stickershop/v{{ $rs->version }}/product/{{ $rs->sticker_code }}/IOS/main_sound.m4a" type="audio/mpeg">
			</audio>
			{!! getStickerResourctTypeIcon($rs->stickerresourcetype) !!}
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

	<!-- ปุ่มสั่งซื้อ -->
	<div class="text-center animate-box" data-animate-effect="fadeInLeft">
		<hr>
			<a href="https://line.me/ti/p/~ratasak1234" target="_blank"><button type="button" class="btn btn-success">สั่งซื้อคลิก</button></a>
			<a href="https://line.me/S/sticker/{{ $rs->sticker_code }}" target="_blank"><button type="button" class="btn btn-secondary">ดูตัวอย่างในแอพไลน์</button></a>
		<hr>
	</div>
	<!-- ปุ่มสั่งซื้อ -->

	@if($rs->detail) 
		<p class="sticker-detail animate-box" data-animate-effect="fadeInLeft">{{ $rs->detail }}</p>
		<p class="animate-box" data-animate-effect="fadeInLeft"><small>*** โปรดแตะที่ตัวสติ๊กเกอร์เพื่อดูตัวอย่าง ***</small></p> 
	@endif

	<div class="animate-box" data-animate-effect="fadeInLeft">
		@if($rs->stamp_start === null)

			<img class="img-fluid" src="https://sdl-stickershop.line.naver.jp/products/0/0/{{ $rs->version }}/{{ $rs->sticker_code }}/LINEStorePC/preview.png" alt="สติ๊กเกอร์ไลน์ {{ $rs->title_th }}">

		@else

			<ul class="list-inline">
				@for($x = $rs->stamp_start; $x <= $rs->stamp_end; $x++)
				@php
					if($rs->stickerresourcetype == 'SOUND' || $rs->stickerresourcetype == 'STATIC'){
						$data_animation = "https://stickershop.line-scdn.net/stickershop/v".$rs->version."/sticker/".$x."/android/sticker.png;compress=true";
					}elseif($rs->stickerresourcetype == 'POPUP' || $rs->stickerresourcetype == 'POPUP_SOUND'){
						$data_animation = "https://stickershop.line-scdn.net/stickershop/v".$rs->version."/sticker/".$x."/IOS/sticker_popup.png;compress=true";
					}
					else{
						$data_animation = "https://stickershop.line-scdn.net/stickershop/v".$rs->version."/sticker/".$x."/IOS/sticker_animation@2x.png;compress=true";
					}
				@endphp
					<li class="sticker-stamp-list">
						<img class="sticker-stamp playAnimate" src="https://stickershop.line-scdn.net/stickershop/v{{ $rs->version }}/sticker/{{ $x }}/android/sticker.png;compress=true" data-animation="{{ $data_animation }}">
						<audio preload="metadata">
							<source src="https://sdl-stickershop.line.naver.jp/products/0/0/{{ $rs->version }}/{{ $rs->sticker_code }}/android/sound/{{ $x }}.m4a" type="audio/mpeg">
						</audio>
					</li>
				@endfor
			</ul>

		@endif
	</div>

	<!-- Social Share -->
	<hr>
	<ul class="list-inline">
		<li class="list-inline-item">
			แชร์ลิ้งค์ : 
		</li>
		<li class="list-inline-item">
			<a href="https://social-plugins.line.me/lineit/share?url={{ Request::url() }}" target="_blank"><i class="fab fa-2x fa-line"></i></a>
		</li>
		<li class="list-inline-item">
			<a href="https://twitter.com/home?status={{ Request::url() }}" target="_blank"><i class="fab fa-2x fa-twitter"></i></a>
		</li>
		<li class="list-inline-item">
			<a href="https://www.facebook.com/sharer/sharer.php?u={{ Request::url() }}" target="_blank"><i class="fab fa-2x fa-facebook-square"></i></a>
		</li>
	</ul>
	<!-- Social Share -->
		
</div>

@endsection
