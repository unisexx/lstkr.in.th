@extends('layouts.front') @section('content')

<div class="fh5co-narrow-content">
	<h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">สติ๊กเกอร์ไลน์ทางการ</h2>
	<div class="animate-box d-flex flex-md-wrap flex-sm-nowrap" data-animate-effect="fadeInLeft">
		@foreach($sticker_official as $row)
		<div class="work-item text-center">
			<a href="{{ url('sticker/product/'.$row->sticker_code) }}">
				<img src="https://sdl-stickershop.line.naver.jp/products/0/0/{{ $row->version }}/{{ $row->sticker_code }}/android/main.png" alt="สติ๊กเกอร์ไลน์ {{ $row->title_th }}" class="img-fluid">
				<h3 class="fh5co-work-title">{{ $row->title_th }}</h3>
				<p>{{ ucfirst($row->category) }}, {{ convert_line_coin_2_money($row->price) }} บาท</p>
			</a>
		</div>
		@endforeach
	</div>
</div>

<div class="fh5co-narrow-content">
	<h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">สติ๊กเกอร์ไลน์ครีเอเตอร์</h2>
	<div class="animate-box d-flex flex-md-wrap flex-sm-nowrap" data-animate-effect="fadeInLeft">
		@foreach($sticker_creator as $row)
		<div class="work-item text-center">
			<a href="{{ url('sticker/product/'.$row->sticker_code) }}">
				<img src="https://sdl-stickershop.line.naver.jp/products/0/0/{{ $row->version }}/{{ $row->sticker_code }}/android/main.png" alt="สติ๊กเกอร์ไลน์ {{ $row->title_th }}" class="img-fluid">
				<h3 class="fh5co-work-title">{{ $row->title_th }}</h3>
				<p>{{ ucfirst($row->category) }}, {{ convert_line_coin_2_money($row->price) }} บาท</p>
			</a>
		</div>
		@endforeach
	</div>
</div>

<div class="fh5co-narrow-content">
	<h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">ธีมไลน์ทางการ</h2>
	<div class="animate-box d-flex flex-md-wrap flex-sm-nowrap" data-animate-effect="fadeInLeft">
		@foreach($theme_official as $row)
		<div class="work-item text-center">
			<a href="{{ url('theme/product/'.$row->id) }}">
				<img src="https://shop.line-scdn.net/themeshop/v1/products/li/st/kr/{{ $row->theme_code }}/1/WEBSTORE/icon_198x278.png" alt="สติ๊กเกอร์ไลน์ {{ $row->title_th }}" class="img-fluid">
				<h3 class="fh5co-work-title">{{ $row->title }}</h3>
				<p>{{ ucfirst($row->category) }}, {{ $row->price }} บาท</p>
			</a>
		</div>
		@endforeach
	</div>
</div>

<div class="fh5co-narrow-content">
	<h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">ธีมไลน์ครีเอเตอร์</h2>
	<div class="animate-box d-flex flex-md-wrap flex-sm-nowrap" data-animate-effect="fadeInLeft">
		@foreach($theme_creator as $row)
		<div class="work-item text-center">
			<a href="{{ url('theme/product/'.$row->id) }}">
				<img src="https://shop.line-scdn.net/themeshop/v1/products/li/st/kr/{{ $row->theme_code }}/1/WEBSTORE/icon_198x278.png" alt="สติ๊กเกอร์ไลน์ {{ $row->title_th }}" class="img-fluid">
				<h3 class="fh5co-work-title">{{ $row->title }}</h3>
				<p>{{ ucfirst($row->category) }}, {{ $row->price }} บาท</p>
			</a>
		</div>
		@endforeach
	</div>
</div>

<div class="fh5co-narrow-content">
	<h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">อิโมจิไลน์ทางการ</h2>
	<div class="animate-box d-flex flex-md-wrap flex-sm-nowrap" data-animate-effect="fadeInLeft">
		@foreach($emoji_official as $row)
		<div class="work-item text-center">
			<a href="{{ url('emoji/product/'.$row->emoji_code) }}">
				<img src="https://stickershop.line-scdn.net/sticonshop/v1/product/{{ $row->emoji_code }}/iphone/main.png" alt="สติ๊กเกอร์ไลน์ {{ $row->title }}" class="img-fluid">
				<h3 class="fh5co-work-title">{{ $row->title }}</h3>
				<p>{{ ucfirst($row->category) }}, {{ $row->price }} บาท</p>
			</a>
		</div>
		@endforeach
	</div>
</div>

<div class="fh5co-narrow-content">
	<h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">อิโมจิไลน์ครีเอเตอร์</h2>
	<div class="animate-box d-flex flex-md-wrap flex-sm-nowrap" data-animate-effect="fadeInLeft">
		@foreach($emoji_creator as $row)
		<div class="work-item text-center">
			<a href="{{ url('emoji/product/'.$row->emoji_code) }}">
				<img src="https://stickershop.line-scdn.net/sticonshop/v1/product/{{ $row->emoji_code }}/iphone/main.png" alt="สติ๊กเกอร์ไลน์ {{ $row->title }}" class="img-fluid">
				<h3 class="fh5co-work-title">{{ $row->title }}</h3>
				<p>{{ ucfirst($row->category) }}, {{ $row->price }} บาท</p>
			</a>
		</div>
		@endforeach
	</div>
</div>

@endsection