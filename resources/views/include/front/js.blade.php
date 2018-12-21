<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
{{-- <script src="{{ elixir('js/app.js') }}"></script> --}}

<script>
    $(document).ready(function(){
        $('.carousel').carousel({
            interval: 1000 * 10
        });

        $(window).scroll(function() {
        if($(this).scrollTop() != 0) {
                $('#footer-back-to-top').fadeIn();
            } else {
                $('#footer-back-to-top').fadeOut();
            }
        });
        
        $('#footer-back-to-top').click(function() {
            $('body,html').animate({scrollTop:0},800);
        }); 

        var alterClass = function() {
            var ww = document.body.clientWidth;
            if (ww < 750) {
            $('.carousel-wrap').removeClass('col-md-12');
            } else if (ww >= 751) {
            $('.carousel-wrap').addClass('col-md-12');
            };
        };
        $(window).resize(function(){
            alterClass();
        });
        //Fire it when the page first loads:
        alterClass();

        var shareData = $('#shareData').data('share_this');
        var dataType = $('#shareData').data('type');
        if(dataType == 'sticker'){
            $('.btn-reddit').attr("href", "https://line.me/S/sticker/"+shareData);
        }else if(dataType == 'theme'){
            $('.btn-reddit').attr("href", "https://line.me/S/shop/theme/detail?id="+shareData);
        }
    });

    function goBack() {
        window.history.back();
    }
    
</script>

<script>
    var popupSize = {
        width: 780,
        height: 550
    };
    $(document).on('click', '.social-buttons > a', function(e){
        var
            verticalPos = Math.floor(($(window).width() - popupSize.width) / 2),
            horisontalPos = Math.floor(($(window).height() - popupSize.height) / 2);

        var popup = window.open($(this).prop('href'), 'social',
            'width='+popupSize.width+',height='+popupSize.height+
            ',left='+verticalPos+',top='+horisontalPos+
            ',location=0,menubar=0,toolbar=0,status=0,scrollbars=1,resizable=1');

        if (popup) {
            popup.focus();
            e.preventDefault();
        }
    });
</script>

<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-11835891-9', 'auto');
    ga('send', 'pageview');
</script>