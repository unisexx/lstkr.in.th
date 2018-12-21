@extends('layouts.front') @section('content')

<div class="row">
	<!-- /.col -->
	<div class="col-md-12 carousel-wrap">
		<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
			<ol class="carousel-indicators">
				<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
				<li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
				<li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
				<li data-target="#carousel-example-generic" data-slide-to="3" class=""></li>
			</ol>
			<div class="carousel-inner">
				<div class="item active">
					<img src="https://i.imgur.com/ViYBUDf.jpg" alt="linepop.in.th">
				</div>
				<div class="item">
					<img src="https://i.imgur.com/oSc61sH.jpg" alt="linepop.in.th">
				</div>
				<div class="item">
					<img src="https://i.imgur.com/zzlfeSW.jpg" alt="linepop.in.th">
				</div>
				<div class="item">
					<img src="https://i.imgur.com/4RlLW2Q.jpg" alt="linepop.in.th">
				</div>
			</div>
			<a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
				<span class="fa fa-angle-left"></span>
			</a>
			<a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
				<span class="fa fa-angle-right"></span>
			</a>
		</div>
	</div>
	<!-- /.col -->
</div>
<br>

<div class="row">
	<div class="col-md-12">
		<div class="box box-default">
			<div class="box-header with-border">
				<span class="more pull-right">
					<a href="{{ url('sticker') }}">ดูเพิ่มเติม ></a>
				</span>
				<h2 class="box-title">สติ๊กเกอร์ไลน์</h2>
				<!-- /.box-tools -->
			</div>
			<!-- /.box-header -->
			<div class="box-body">
				@foreach($sticker as $row)
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

<div class="row">
	<div class="col-md-12">
		<div class="box box-default">
			<div class="box-header with-border">
				<span class="more pull-right">
					<a href="{{ url('theme') }}">ดูเพิ่มเติม ></a>
				</span>
				<h2 class="box-title">ธีมไลน์</h2>
				<!-- /.box-tools -->
			</div>
			<!-- /.box-header -->
			<div class="box-body">
				@foreach($theme as $row)
				<div class="col-xs-4 col-sm-3 col-md-2">
					<div class="panel panel-default">
						<div class="panel-body">
							<a href="{{ url('theme/'.$row->slug) }}">
								<div>
									<img class="img-responsive" src="https://shop.line-scdn.net/themeshop/v1/products/{{ $row->theme_path }}/WEBSTORE/icon_136x190.png">
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