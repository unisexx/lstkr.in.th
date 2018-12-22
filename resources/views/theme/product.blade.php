@extends('layouts.front')

@section('content')

<div class="fh5co-narrow-content">

	<div class="d-flex justify-content-center animate-box" data-animate-effect="fadeInLeft">

		<div class="">
			<img src="{{ $rs->cover }}" alt="ธีมไลน์ {{ $rs->title }}">
		</div>

		<div class="sticker-detail">
			<h3>{{ $rs->title }}</h3>
			<p>{{ $rs->detail }}</p>
			<ul>
				<li>ราคา : {{ $rs->price }} บาท</li>
				<li>ประเภท : {{ $rs->category }}</li>
				<li>ประเทศ : {{ $rs->category }}</li>
			</ul>
		</div>
	</div>

	<div class="d-flex flex-wrap justify-content-center animate-box" data-animate-effect="fadeInLeft">
		@for($x = 1; $x <= 5; $x++)
			<div class="theme-image-detail">
				<img class="img-fluid" src="<?php echo $rs['preview_'.$x]?>" alt="ธีมไลน์ <?php echo $rs['title']?>">
			</div>
		@endfor
	</div>
		
</div>

@endsection
