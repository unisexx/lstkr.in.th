@extends('layouts.front') @section('content')

<div class="fh5co-narrow-content single-item mb-4">
	<div><a href="https://line2me.in.th/page/view/22" target="_blank"><img class="img-fluid" src="https://line2me.in.th/image/free_promote.png" alt="โปรโมทสติ๊กเกอร์ไลน์"></a></div>
  	{{-- <div><a href="https://line.me/R/ti/p/HuNn5V9sfP"><img class="img-fluid" src="https://line2me.in.th/image/banner.jpg" alt="linesticker.in.th"></a></div> --}}
</div>


@if(count($sticker_promote) != 0)
<div class="fh5co-narrow-content">
	<div class="d-flex justify-content-between align-items-baseline animate-box" data-animate-effect="fadeInLeft">
		<h2 class="fh5co-heading">สติ๊กเกอร์ไลน์แนะนำ</h2>
		<p class="text-right read-more-text"><a href="{{ url('page/view/8') }}">สนใจโปรโมทสติ๊กเกอร์ ธีม อิโมจิไลน์ของท่านอ่านรายละเอียดที่นี่จ้า ></a></p>
	</div>
	<div class="animate-box d-flex flex-md-wrap flex-sm-nowrap" data-animate-effect="fadeInLeft">
		@foreach($sticker_promote as $row)
		<div class="work-item text-center">
			{!! new_icon($row->created_at) !!}
			<a href="{{ url('sticker/product/'.$row->sticker_code) }}">
				<div class="sticker-image-cover">
					<img src="https://sdl-stickershop.line.naver.jp/products/0/0/{{ $row->version }}/{{ $row->sticker_code }}/android/main.png" alt="สติ๊กเกอร์ไลน์ {{ $row->title_th }}" class="img-fluid">
					{!! getStickerResourctTypeIcon($row->stickerresourcetype) !!}
				</div>
				<h3 class="fh5co-work-title">{{ $row->title_th }}</h3>
				<p>{{ ucfirst($row->country) }}, {{ convert_line_coin_2_money($row->price) }} บาท</p>
			</a>
		</div>
		@endforeach
	</div>
</div>
@endif


@if(count($emoji_promote) != 0)
<div class="fh5co-narrow-content">
	<div class="d-flex justify-content-between align-items-baseline animate-box" data-animate-effect="fadeInLeft">
		<h2 class="fh5co-heading">อิโมจิไลน์แนะนำ</h2>
	</div>
	<div class="animate-box d-flex flex-md-wrap flex-sm-nowrap" data-animate-effect="fadeInLeft">
		@foreach($emoji_promote as $row)
		<div class="work-item text-center">
			{!! new_icon($row->created_at) !!}
			<a href="{{ url('emoji/product/'.$row->id) }}">
				<img src="https://stickershop.line-scdn.net/sticonshop/v1/product/{{ $row->emoji_code }}/iphone/main.png" alt="อิโมจิไลน์ {{ $row->title }}" class="img-fluid">
				<h3 class="fh5co-work-title">{{ $row->title }}</h3>
				<p>{{ ucfirst($row->country) }}, {{ $row->price }} บาท</p>
			</a>
		</div>
		@endforeach
	</div>
</div>
@endif


@if(count($theme_promote) != 0)
<div class="fh5co-narrow-content">
	<div class="d-flex justify-content-between align-items-baseline animate-box" data-animate-effect="fadeInLeft">
		<h2 class="fh5co-heading">ธีมไลน์แนะนำ</h2>
	</div>
	<div class="animate-box d-flex flex-md-wrap flex-sm-nowrap" data-animate-effect="fadeInLeft">
		@foreach($theme_promote as $row)
		<div class="work-item text-center">
			{!! new_icon($row->created_at) !!}
			<a href="{{ url('theme/product/'.$row->id) }}">
				<img src="https://shop.line-scdn.net/themeshop/v1/products/li/st/kr/{{ $row->theme_code }}/1/WEBSTORE/icon_198x278.png" alt="ธีมไลน์ {{ $row->title }}" class="img-fluid">
				<h3 class="fh5co-work-title">{{ $row->title }}</h3>
				<p>{{ ucfirst($row->country) }}, {{ $row->price }} บาท</p>
			</a>
		</div>
		@endforeach
	</div>
</div>
@endif


@if(count($sticker_update) != 0)
<div class="fh5co-narrow-content">
	<div class="d-flex justify-content-between align-items-baseline animate-box" data-animate-effect="fadeInLeft">
		<h2 class="fh5co-heading">สติ๊กเกอร์ไลน์ทางการมาใหม่</h2>
	</div>
	<div class="animate-box d-flex flex-md-wrap flex-sm-nowrap" data-animate-effect="fadeInLeft">
		@foreach($sticker_update as $row)
		<div class="work-item text-center">
			{!! new_icon($row->created_at) !!}
			<a href="{{ url('sticker/product/'.$row->sticker_code) }}">
				<div class="sticker-image-cover">
					<img src="https://sdl-stickershop.line.naver.jp/products/0/0/{{ $row->version }}/{{ $row->sticker_code }}/android/main.png" alt="สติ๊กเกอร์ไลน์ {{ $row->title_th }}" class="img-fluid">
					{!! getStickerResourctTypeIcon($row->stickerresourcetype) !!}
				</div>
				<h3 class="fh5co-work-title">{{ $row->title_th }}</h3>
				<p>{{ ucfirst($row->country) }}, {{ convert_line_coin_2_money($row->price) }} บาท</p>
			</a>
		</div>
		@endforeach
	</div>
</div>
@endif


@if(count($emoji_update) != 0)
<div class="fh5co-narrow-content">
	<div class="d-flex justify-content-between align-items-baseline animate-box" data-animate-effect="fadeInLeft">
		<h2 class="fh5co-heading">อิโมจิไลน์ทางการมาใหม่</h2>
	</div>
	<div class="animate-box d-flex flex-md-wrap flex-sm-nowrap" data-animate-effect="fadeInLeft">
		@foreach($emoji_update as $row)
		<div class="work-item text-center">
			{!! new_icon($row->created_at) !!}
			<a href="{{ url('emoji/product/'.$row->id) }}">
				<img src="https://stickershop.line-scdn.net/sticonshop/v1/product/{{ $row->emoji_code }}/iphone/main.png" alt="อิโมจิไลน์ {{ $row->title }}" class="img-fluid">
				<h3 class="fh5co-work-title">{{ $row->title }}</h3>
				<p>{{ ucfirst($row->country) }}, {{ $row->price }} บาท</p>
			</a>
		</div>
		@endforeach
	</div>
</div>
@endif


@if(count($theme_update) != 0)
<div class="fh5co-narrow-content">
	<div class="d-flex justify-content-between align-items-baseline animate-box" data-animate-effect="fadeInLeft">
		<h2 class="fh5co-heading">ธีมไลน์ทางการมาใหม่</h2>
	</div>
	<div class="animate-box d-flex flex-md-wrap flex-sm-nowrap" data-animate-effect="fadeInLeft">
		@foreach($theme_update as $row)
		<div class="work-item text-center">
			{!! new_icon($row->created_at) !!}
			<a href="{{ url('theme/product/'.$row->id) }}">
				<img src="https://shop.line-scdn.net/themeshop/v1/products/li/st/kr/{{ $row->theme_code }}/1/WEBSTORE/icon_198x278.png" alt="ธีมไลน์ {{ $row->title_th }}" class="img-fluid">
				<h3 class="fh5co-work-title">{{ $row->title }}</h3>
				<p>{{ ucfirst($row->country) }}, {{ $row->price }} บาท</p>
			</a>
		</div>
		@endforeach
	</div>
</div>
@endif


<div class="fh5co-narrow-content">
	<div class="d-flex justify-content-between align-items-baseline animate-box" data-animate-effect="fadeInLeft">
		<h2 class="fh5co-heading">สติ๊กเกอร์ไลน์ทางการไทย</h2>
		<p class="text-right read-more-text"><a href="{{ url('sticker/official/thai/top') }}">ดูทั้งหมด ></a></p>
	</div>
	<div class="animate-box d-flex flex-md-wrap flex-sm-nowrap" data-animate-effect="fadeInLeft">
		@foreach($sticker_official_thai as $row)
		<div class="work-item text-center">
			{!! new_icon($row->created_at) !!}
			<a href="{{ url('sticker/product/'.$row->sticker_code) }}">
				<div class="sticker-image-cover">
					<img src="https://sdl-stickershop.line.naver.jp/products/0/0/{{ $row->version }}/{{ $row->sticker_code }}/android/main.png" alt="สติ๊กเกอร์ไลน์ {{ $row->title_th }}" class="img-fluid">
					{!! getStickerResourctTypeIcon($row->stickerresourcetype) !!}
				</div>
				<h3 class="fh5co-work-title">{{ $row->title_th }}</h3>
				<p>{{ ucfirst($row->country) }}, {{ convert_line_coin_2_money($row->price) }} บาท</p>
			</a>
		</div>
		@endforeach
	</div>
</div>


<div class="fh5co-narrow-content">
	<div class="d-flex justify-content-between align-items-baseline animate-box" data-animate-effect="fadeInLeft">
		<h2 class="fh5co-heading">สติ๊กเกอร์ไลน์ทางการต่างประเทศ</h2>
		<p class="text-right read-more-text"><a href="{{ url('sticker/official/oversea/top') }}">ดูทั้งหมด ></a></p>
	</div>
	<div class="animate-box d-flex flex-md-wrap flex-sm-nowrap" data-animate-effect="fadeInLeft">
		@foreach($sticker_official_oversea as $row)
		<div class="work-item text-center">
			{!! new_icon($row->created_at) !!}
			<a href="{{ url('sticker/product/'.$row->sticker_code) }}">
				<div class="sticker-image-cover">
					<img src="https://sdl-stickershop.line.naver.jp/products/0/0/{{ $row->version }}/{{ $row->sticker_code }}/android/main.png" alt="สติ๊กเกอร์ไลน์ {{ $row->title_th }}" class="img-fluid">
					{!! getStickerResourctTypeIcon($row->stickerresourcetype) !!}
				</div>
				<h3 class="fh5co-work-title">{{ $row->title_th }}</h3>
				<p>{{ ucfirst($row->country) }}, {{ convert_line_coin_2_money($row->price) }} บาท</p>
			</a>
		</div>
		@endforeach
	</div>
</div>

<div class="fh5co-narrow-content">
	<div class="d-flex justify-content-between align-items-baseline animate-box" data-animate-effect="fadeInLeft">
		<h2 class="fh5co-heading">สติ๊กเกอร์ไลน์ครีเอเตอร์</h2>
		<p class="text-right read-more-text"><a href="{{ url('sticker/creator/top') }}">ดูทั้งหมด ></a></p>
	</div>
	<div class="animate-box d-flex flex-md-wrap flex-sm-nowrap" data-animate-effect="fadeInLeft">
		@foreach($sticker_creator as $row)
		<div class="work-item text-center">
			<a href="{{ url('sticker/product/'.$row->sticker_code) }}">
				<div class="sticker-image-cover">
					<img src="https://sdl-stickershop.line.naver.jp/products/0/0/{{ $row->version }}/{{ $row->sticker_code }}/android/main.png" alt="สติ๊กเกอร์ไลน์ {{ $row->title_th }}" class="img-fluid">
					{!! getStickerResourctTypeIcon($row->stickerresourcetype) !!}
				</div>
				<h3 class="fh5co-work-title">{{ $row->title_th }}</h3>
				<p>{{ ucfirst($row->country) }}, {{ convert_line_coin_2_money($row->price) }} บาท</p>
			</a>
		</div>
		@endforeach
	</div>
</div>

<div class="fh5co-narrow-content">
	<div class="d-flex justify-content-between align-items-baseline animate-box" data-animate-effect="fadeInLeft">
		<h2 class="fh5co-heading">อิโมจิไลน์ทางการไทย</h2>
		<p class="text-right read-more-text"><a href="{{ url('emoji/official/thai/top') }}">ดูทั้งหมด ></a></p>
	</div>
	<div class="animate-box d-flex flex-md-wrap flex-sm-nowrap" data-animate-effect="fadeInLeft">
		@foreach($emoji_official_thai as $row)
		<div class="work-item text-center">
			{!! new_icon($row->created_at) !!}
			<a href="{{ url('emoji/product/'.$row->id) }}">
				<img src="https://stickershop.line-scdn.net/sticonshop/v1/product/{{ $row->emoji_code }}/iphone/main.png" alt="อิโมจิไลน์ {{ $row->title }}" class="img-fluid">
				<h3 class="fh5co-work-title">{{ $row->title }}</h3>
				<p>{{ ucfirst($row->country) }}, {{ $row->price }} บาท</p>
			</a>
		</div>
		@endforeach
	</div>
</div>

<div class="fh5co-narrow-content">
	<div class="d-flex justify-content-between align-items-baseline animate-box" data-animate-effect="fadeInLeft">
		<h2 class="fh5co-heading">อิโมจิไลน์ทางการต่างประเทศ</h2>
		<p class="text-right read-more-text"><a href="{{ url('emoji/official/oversea/top') }}">ดูทั้งหมด ></a></p>
	</div>
	<div class="animate-box d-flex flex-md-wrap flex-sm-nowrap" data-animate-effect="fadeInLeft">
		@foreach($emoji_official_oversea as $row)
		<div class="work-item text-center">
			{!! new_icon($row->created_at) !!}
			<a href="{{ url('emoji/product/'.$row->id) }}">
				<img src="https://stickershop.line-scdn.net/sticonshop/v1/product/{{ $row->emoji_code }}/iphone/main.png" alt="อิโมจิไลน์ {{ $row->title }}" class="img-fluid">
				<h3 class="fh5co-work-title">{{ $row->title }}</h3>
				<p>{{ ucfirst($row->country) }}, {{ $row->price }} บาท</p>
			</a>
		</div>
		@endforeach
	</div>
</div>

<div class="fh5co-narrow-content">
	<div class="d-flex justify-content-between align-items-baseline animate-box" data-animate-effect="fadeInLeft">
		<h2 class="fh5co-heading">อิโมจิไลน์ครีเอเตอร์</h2>
		<p class="text-right read-more-text"><a href="{{ url('emoji/creator/top') }}">ดูทั้งหมด ></a></p>
	</div>
	<div class="animate-box d-flex flex-md-wrap flex-sm-nowrap" data-animate-effect="fadeInLeft">
		@foreach($emoji_creator as $row)
		<div class="work-item text-center">
			<a href="{{ url('emoji/product/'.$row->id) }}">
				<img src="https://stickershop.line-scdn.net/sticonshop/v1/product/{{ $row->emoji_code }}/iphone/main.png" alt="อิโมจิไลน์ {{ $row->title }}" class="img-fluid">
				<h3 class="fh5co-work-title">{{ $row->title }}</h3>
				<p>{{ ucfirst($row->country) }}, {{ $row->price }} บาท</p>
			</a>
		</div>
		@endforeach
	</div>
</div>

<div class="fh5co-narrow-content">
	<div class="d-flex justify-content-between align-items-baseline animate-box" data-animate-effect="fadeInLeft">
		<h2 class="fh5co-heading">ธีมไลน์ทางการไทย</h2>
		<p class="text-right read-more-text"><a href="{{ url('theme/official/thai/top') }}">ดูทั้งหมด ></a></p>
	</div>
	<div class="animate-box d-flex flex-md-wrap flex-sm-nowrap" data-animate-effect="fadeInLeft">
		@foreach($theme_official_thai as $row)
		<div class="work-item text-center">
			{!! new_icon($row->created_at) !!}
			<a href="{{ url('theme/product/'.$row->id) }}">
				<img src="https://shop.line-scdn.net/themeshop/v1/products/li/st/kr/{{ $row->theme_code }}/1/WEBSTORE/icon_198x278.png" alt="ธีมไลน์ {{ $row->title_th }}" class="img-fluid">
				<h3 class="fh5co-work-title">{{ $row->title }}</h3>
				<p>{{ ucfirst($row->country) }}, {{ $row->price }} บาท</p>
			</a>
		</div>
		@endforeach
	</div>
</div>

<div class="fh5co-narrow-content">
	<div class="d-flex justify-content-between align-items-baseline animate-box" data-animate-effect="fadeInLeft">
		<h2 class="fh5co-heading">ธีมไลน์ทางการต่างประเทศ</h2>
		<p class="text-right read-more-text"><a href="{{ url('theme/official/oversea/top') }}">ดูทั้งหมด ></a></p>
	</div>
	<div class="animate-box d-flex flex-md-wrap flex-sm-nowrap" data-animate-effect="fadeInLeft">
		@foreach($theme_official_oversea as $row)
		<div class="work-item text-center">
			{!! new_icon($row->created_at) !!}
			<a href="{{ url('theme/product/'.$row->id) }}">
				<img src="https://shop.line-scdn.net/themeshop/v1/products/li/st/kr/{{ $row->theme_code }}/1/WEBSTORE/icon_198x278.png" alt="ธีมไลน์ {{ $row->title_th }}" class="img-fluid">
				<h3 class="fh5co-work-title">{{ $row->title }}</h3>
				<p>{{ ucfirst($row->country) }}, {{ $row->price }} บาท</p>
			</a>
		</div>
		@endforeach
	</div>
</div>

<div class="fh5co-narrow-content">
	<div class="d-flex justify-content-between align-items-baseline animate-box" data-animate-effect="fadeInLeft">
		<h2 class="fh5co-heading">ธีมไลน์ครีเอเตอร์</h2>
		<p class="text-right read-more-text"><a href="{{ url('theme/creator/top') }}">ดูทั้งหมด ></a></p>
	</div>
	<div class="animate-box d-flex flex-md-wrap flex-sm-nowrap" data-animate-effect="fadeInLeft">
		@foreach($theme_creator as $row)
		<div class="work-item text-center">
			<a href="{{ url('theme/product/'.$row->id) }}">
				<img src="https://shop.line-scdn.net/themeshop/v1/products/li/st/kr/{{ $row->theme_code }}/1/WEBSTORE/icon_198x278.png" alt="ธีมไลน์ {{ $row->title_th }}" class="img-fluid">
				<h3 class="fh5co-work-title">{{ $row->title }}</h3>
				<p>{{ ucfirst($row->country) }}, {{ $row->price }} บาท</p>
			</a>
		</div>
		@endforeach
	</div>
</div>

@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css">
<style>
.slick-prev:before, .slick-next:before{
	color:#9e9e9e !important;
}
.slick-dots li button:before{
	font-size: 13px;
}
</style>
@endpush

@push('js')
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script>
$(document).ready(function(){
	$('.single-item').slick({
		dots:true,
		autoplay:true,
		speed: 1000,
		autoplaySpeed: 5000,
	});
});
</script>
@endpush