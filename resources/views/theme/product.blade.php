@extends('layouts.front')

@section('content')

<div class="fh5co-narrow-content">

	<div class="d-flex animate-box" data-animate-effect="fadeInLeft">

		<div class="sticker-image-cover">
			<img class="img-fluid" src="https://shop.line-scdn.net/themeshop/v1/products/li/st/kr/{{ $rs->theme_code }}/1/WEBSTORE/icon_198x278.png" alt="ธีมไลน์ {{ $rs->title }}">
		</div>

		<div class="sticker-infomation">
			<h3>{{ $rs->title }}</h3>
			<ul>
				<li>ราคา : {{ $rs->price }} บาท</li>
				<li>ประเภท : {{ $rs->category }}</li>
				<li>ประเทศ : {{ $rs->category }}</li>
			</ul>
		</div>
		
	</div>

	@if($rs->detail) <p class="sticker-detail">{{ $rs->detail }}</p> @endif

	<div class="d-flex flex-xl-wrap flex-lg-nowrap animate-box theme-image-detail-wrap" data-animate-effect="fadeInLeft">
		@for($x = 1; $x <= 5; $x++)
			<img class="align-self-baseline theme-image-detail" src="http://sdl-shop.line.naver.jp/themeshop/v1/products/li/st/kr/{{ $rs->theme_code }}/1/ANDROID/th/preview_00{{ $x }}_720x1232.png" alt="ธีมไลน์ <?php echo $rs['title']?>">
		@endfor
	</div>
		
</div>

@endsection
