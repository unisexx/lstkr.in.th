@extends('layouts.front')

@section('content')

<div class="fh5co-narrow-content">
	<h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">สติ๊กเกอร์ไลน์ครีเอเตอร์</h2>
	<div class="row animate-box d-flex flex-wrap justify-content-center" data-animate-effect="fadeInLeft">
		@foreach($sticker as $row)
		<div class="work-item text-center">
			<a href="{{ url('sticker/product/'.$row->sticker_code) }}">
				<img src="https://sdl-stickershop.line.naver.jp/products/0/0/{{ $row->version }}/{{ $row->sticker_code }}/android/main.png" alt="สติ๊กเกอร์ไลน์ {{ $row->title_th }}" class="img-fluid">
				<h3 class="fh5co-work-title">{{ $row->title_th }}</h3>
				<p>{{ ucfirst($row->category) }}, {{ convert_line_coin_2_money($row->price) }} บาท</p>
			</a>
		</div>
		@endforeach
		<div class="clearfix visible-md-block"></div>
		{{ $sticker->appends(@$_GET)->render() }}
	</div>
</div>

@endsection
