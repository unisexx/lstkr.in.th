{{-- deleteDuplicate() --}}

<nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    Linepop
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/sticker') }}">สติ๊กเกอร์</a></li>
                    <li><a href="{{ url('/theme') }}">ธีม</a></li>
                </ul>
                <div class="col-sm-5 col-md-4">
                    {{Form::open(array('url'=>'search', 'method'=>'get', 'class'=>'navbar-form','role'=>'search'))}}
						<div class="input-group">
							<input type="text" class="form-control" placeholder="ค้นหา" name="q" id="srch-term" value="{{ @$_GET['q'] }}">
							<div class="input-group-btn">
								<button class="btn bg-green" type="submit"><i class="glyphicon glyphicon-search"></i></button>
							</div>
						</div>
                    {{Form::close()}}
				</div>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">เข้าสู่ระบบ</a></li>
                        <li><a href="{{ url('/register') }}">สมัครสมาชิก</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/creator/dashboard') }}"><i class="fa fa-btn fa-gears"></i>จัดการข้อมูล</a></li>
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>ออกจากระบบ</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>