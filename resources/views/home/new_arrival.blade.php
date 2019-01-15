@extends('layouts.front') @section('content')

<div class="fh5co-narrow-content">
	<div class="d-flex justify-content-between align-items-baseline animate-box" data-animate-effect="fadeInLeft">
		<h2 class="fh5co-heading">สติ๊กเกอร์ไลน์อัพเดท <small class="text-black-50">({{ DBToDate($new_arrival->created_at) }})</small></h2>
	</div>
	<div class="animate-box d-flex flex-md-wrap flex-sm-nowrap" data-animate-effect="fadeInLeft">
		@foreach($product as $row)
			@if($row->product_type == 'sticker')
				<div class="work-item text-center">
					<!-- {!! new_icon($row->sticker_created) !!} -->
					<a href="{{ url('sticker/product/'.$row->sticker_code) }}">
						<img src="https://sdl-stickershop.line.naver.jp/products/0/0/{{ $row->version }}/{{ $row->sticker_code }}/android/main.png" alt="สติ๊กเกอร์ไลน์ {{ $row->sticker_title_th }}" class="img-fluid">
						<h3 class="fh5co-work-title">{{ $row->sticker_title_th }}</h3>
						<p>{{ ucfirst($row->sticker_country) }}, {{ convert_line_coin_2_money($row->sticker_price) }} บาท</p>
					</a>
				</div>
			@endif
		@endforeach
	</div>
</div>

<div class="fh5co-narrow-content">
	<div class="d-flex justify-content-between align-items-baseline animate-box" data-animate-effect="fadeInLeft">
		<h2 class="fh5co-heading">ธีมไลน์อัพเดท <small class="text-black-50">({{ DBToDate($new_arrival->created_at) }})</small></h2>
	</div>
	<div class="animate-box d-flex flex-md-wrap flex-sm-nowrap" data-animate-effect="fadeInLeft">
		@foreach($product as $row)
			@if($row->product_type == 'theme')
				<div class="work-item text-center">
					<!-- {!! new_icon($row->theme_created) !!} -->
					<a href="{{ url('theme/product/'.$row->theme_id) }}">
						<img src="https://shop.line-scdn.net/themeshop/v1/products/li/st/kr/{{ $row->theme_code }}/1/WEBSTORE/icon_198x278.png" alt="ธีมไลน์ {{ $row->theme_title }}" class="img-fluid">
						<h3 class="fh5co-work-title">{{ $row->theme_title }}</h3>
						<p>{{ ucfirst($row->theme_country) }}, {{ $row->theme_price }} บาท</p>
					</a>
				</div>
			@endif
		@endforeach
	</div>
</div>

<div class="fh5co-narrow-content">
	<div class="d-flex justify-content-between align-items-baseline animate-box" data-animate-effect="fadeInLeft">
		<h2 class="fh5co-heading">อิโมจิไลน์อัพเดท <small class="text-black-50">({{ DBToDate($new_arrival->created_at) }})</small></h2>
	</div>
	<div class="animate-box d-flex flex-md-wrap flex-sm-nowrap" data-animate-effect="fadeInLeft">
		@foreach($product as $row)
			@if($row->product_type == 'emoji')
				<div class="work-item text-center">
					<!-- {!! new_icon($row->emoji_created) !!} -->
					<a href="{{ url('emoji/product/'.$row->emoji_id) }}">
						<img src="https://stickershop.line-scdn.net/sticonshop/v1/product/{{ $row->emoji_code }}/iphone/main.png" alt="อิโมจิไลน์ {{ $row->emoji_title }}" class="img-fluid">
						<h3 class="fh5co-work-title">{{ $row->emoji_title }}</h3>
						<p>{{ ucfirst($row->emoji_country) }}, {{ $row->emoji_price }} บาท</p>
					</a>
				</div>
			@endif
		@endforeach
	</div>
</div>

@endsection