@extends('layouts.front') @section('content')
<div class="fh5co-narrow-content">
    <form class="bd-search d-flex align-items-center" method="get" action="{{ url('search') }}">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="ค้นหา" name="q" value="{{ @$_GET['q'] }}">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2" style="margin:0px;"><i class="icon-search"></i></button>
            </div>
        </div>
    </form>
</div>

<div class="fh5co-narrow-content">
	<h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">สติ๊กเกอร์ไลน์</h2>
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
	</div>
</div>

<div class="fh5co-narrow-content">
	<h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">ธีมไลน์</h2>
	<div class="row animate-box d-flex flex-wrap justify-content-center" data-animate-effect="fadeInLeft">
		@foreach($theme as $row)
		<div class="work-item text-center">
			<a href="{{ url('theme/product/'.$row->id) }}">
				<img src="{{ $row->cover }}" alt="สติ๊กเกอร์ไลน์ {{ $row->title_th }}" class="img-fluid">
				<h3 class="fh5co-work-title">{{ $row->title }}</h3>
				<p>{{ ucfirst($row->category) }}, {{ $row->price }} บาท</p>
			</a>
		</div>
		@endforeach
	</div>
</div>

<div class="fh5co-narrow-content">
	<h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">อิโมจิไลน์</h2>
	<div class="row animate-box d-flex flex-wrap justify-content-center" data-animate-effect="fadeInLeft">
		@foreach($emoji as $row)
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