@extends('layouts.front')

@section('content')

<div class="fh5co-narrow-content">
	<h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">ธีมไลน์ทางการ</h2>

	<select class="custom-select col-md-2 animate-box" data-animate-effect="fadeInLeft" onchange="location = '{{ Request::root() }}/theme/official/'+this.value;">
		<option value="top" {{ Request::segment(3) == 'top' ? 'selected' : '' }}>ฮิต</option>
		<option value="new" {{ Request::segment(3) == 'new' ? 'selected' : '' }}>ใหม่ล่าสุด</option>
	</select>

	<div class="animate-box d-flex flex-wrap" data-animate-effect="fadeInLeft">
		@foreach($theme as $row)
		<div class="work-item text-center">
			<a href="{{ url('theme/product/'.$row->id) }}">
				<img src="https://shop.line-scdn.net/themeshop/v1/products/li/st/kr/{{ $row->theme_code }}/1/WEBSTORE/icon_198x278.png" alt="ธีมไลน์ {{ $row->title }}" class="img-fluid">
				<h3 class="fh5co-work-title">{{ $row->title }}</h3>
				<p>{{ ucfirst($row->category) }}, {{ $row->price }} บาท</p>
			</a>
		</div>
		@endforeach
		<div class="clearfix visible-md-block"></div>
		{{ $theme->appends(@$_GET)->render() }}
	</div>
</div>

@endsection
