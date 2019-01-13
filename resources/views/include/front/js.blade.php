<!-- jQuery -->
<script src="nitro_theme/js/jquery.min.js"></script>
<!-- jQuery Easing -->
<script src="nitro_theme/js/jquery.easing.1.3.js"></script>
<!-- Bootstrap -->
<!-- <script src="nitro_theme/js/bootstrap.min.js"></script> -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<!-- Carousel -->
<script src="nitro_theme/js/owl.carousel.min.js"></script>
<!-- Stellar -->
<script src="nitro_theme/js/jquery.stellar.min.js"></script>
<!-- Waypoints -->
<script src="nitro_theme/js/jquery.waypoints.min.js"></script>
<!-- Counters -->
<script src="nitro_theme/js/jquery.countTo.js"></script>
<!-- MAIN JS -->
<script src="nitro_theme/js/main.js"></script>

<script>
$('ducument').ready(function(){
    // ใส่ class img-fluid ให้รูปในหน้า Page เพื่อทำ responsive
    $('.pageContent img').attr('class', 'img-fluid');

    // อัพเดทยอดวิว
    var productType = "{{ Request::segment(1) }}";
    var productPage = "{{ Request::segment(2) }}";
    var productID = "{{ Request::segment(3) }}";
    // console.log(productID);
    if(productPage == 'product'){
        $.ajax({
            url: '{{ url("ajax/updateviewcount") }}',
            data:{ productType : productType, productID : productID }
        });
    }

    if(productType == 'sticker' && ($('.sticker-stamp').length == 0)){

        // alert('get_stamp');
        $.ajax({
            url: '{{ url("ajax/updatestamp") }}',
            data:{ sticker_code : productID }
        });
    }

    // เปิด sticker stamp animation ตอนคลิก
    $('.playAnimate').click(function(){
        // หยุดเสียงทั้งหมด
        $('audio').each(function(){
            this.pause(); // Stop playing
            this.currentTime = 0; // Reset time
        }); 

        // เล่นเสียง
        var audio = $(this).next('audio')[0];
        audio.play();

        // เล่น sticker animation
		$(this).attr("src", $(this).data('animation'));
        
        // $(this).css( "opacity", "1" ).siblings().css( "opacity", "0.2" ).delay(3000)
        // .queue(function (next) { 
        //     $('.playAnimate').css("opacity", "1"); 
        //     next(); 
        // });
    });
});
</script>