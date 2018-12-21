@extends('layouts.front_view')

@section('content')
<span id="shareData" data-type="sticker" data-share_this="{{ $rs->sticker_code }}"></span>
<div class="clearfix">
	<div class="col-xs-5 col-sm-5 col-md-5 img-cover">
		@if($rs->stickerresourcetype == 'ANIMATION')
			<img class="img-responsive" src="https://stickershop.line-scdn.net/stickershop/v{{ $rs->version }}/product/{{ $rs->sticker_code }}/IOS/main_animation.png">
			<span class="MdIcoPlay_b">Animation only icon</span>
		@else
			<img class="img-responsive" src="https://sdl-stickershop.line.naver.jp/products/0/0/{{ $rs->version }}/{{ $rs->sticker_code }}/LINEStorePC/main.png;compress=true">
		@endif
	</div>

	<div class="col-xs-7 col-sm-7 col-md-7">
		<small>{{ $rs->head_credit }}</small>
		<h1>{{ $rs->name }}</h2>
		<p>{{ $rs->description }}</p>
		<p class="price">{{ $rs->price }}</p>
		@widget('socialShareBtn')
	</div>
</div>

<div class="clearfix btnShop">
	<a href="http://line.me/ti/p/~ratasak1234" class="btn btn-block btn-success"><i class="fa fa-gift" aria-hidden="true"></i> สั่งซื้อสติ๊กเกอร์ไลน์ชุดนี้</a>
</div>

<hr>
<style>
/* .tag a       { color:#0000de; text-decoration:none; }
.tag a:link  { color:#0000de; text-decoration:none; }
.tag a:visited { color:#0000de; text-decoration:none; }
.tag a:hover { color:#cc6600; text-decoration:underline; } */
.stickerSub {
    height: 80px;
    margin: 5px 0px 25px 0px;
}
.stickerSub img{height: auto; width: 100%; margin: 5px auto;}
@media screen and (min-width: 400px) {
    .stickerSub {
        height: 40px;
        margin: 15px 0px 60px 0px;
    }
}
@media screen and (min-width: 767px) {
    .stickerSub {
        height: 150px;
        margin: 15px 0px 60px 0px;
    }
}
</style>
@if(count($rs->stamp) == 0)
	<img class="img-responsive" src="https://sdl-stickershop.line.naver.jp/products/0/0/{{ $rs->version }}/{{ $rs->sticker_code }}/LINEStorePC/preview.png" alt="สติ๊กเกอร์ไลน์ {{ $rs->name }}">
@else
<div class="row">
	<ul class="clearfix" style="padding-left: 10px;padding-right: 10px;">
		@foreach($rs->stamp()->get() as $key=>$row)
			<li class="stickerSub col-xs-3 col-sm-3 col-md-3" style="display:inline-block;padding-left:5px;padding-right:5px;">
				<img src="https://stickershop.line-scdn.net/stickershop/v{{ $row->version }}/sticker/{{ $row->stamp_code }}/android/sticker.png;compress=true" anim-width="150%" anim-height="auto">
				@if($row->tag != "")
					@php
						$tags = explode(',',$row->tag);
					@endphp
					<div class="tag small">
						@php
							$myArray = "";
							foreach($tags as $key){
								$myArray[] = '<a href="'.url('tag/'.trim($key)).'">'.trim($key).'</a>';
							}
							echo str_replace(',',' |',implode( ', ', $myArray ));
						@endphp
					</div>
				@endif
			</li>
		@endforeach
	</ul>
</div>
@endif



<div class="row">
	<div class="col-md-12">
		<div class="box box-default">
			<div class="box-header with-border">
				<span class="more pull-right">
					<a href="{{ url('author/'.$rs->user_id) }}">ดูเพิ่มเติม ></a>
				</span>
				<h2 class="box-title">สติ๊กเกอร์ชุดอื่นๆของ <span class="text-green">{{ $rs->head_credit }}</span></h2>
				<!-- /.box-tools -->
			</div>
			<!-- /.box-header -->
			<div class="box-body">
				@foreach($other as $row)
				<div class="col-xs-4 col-sm-3 col-md-2">
					<div class="panel panel-default">
						<div class="panel-body">
							<a href="{{ url('sticker/'.$row->slug) }}">
								<div class="img-cover">
									<img class="img-responsive" src="https://sdl-stickershop.line.naver.jp/products/0/0/{{ $row->version }}/{{ $row->sticker_code }}/android/main.png"> @if($row->stickerresourcetype == 'ANIMATION')
									<span class="MdIcoPlay_m">Animation only icon</span>
									@endif
								</div>
								<h3>{{ $row->name }}</h3>
							</a>
						</div>
					</div>
				</div>
				@endforeach
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->
	</div>
</div>

@endsection
