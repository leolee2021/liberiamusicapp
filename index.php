<?php require_once('private/init.php');

$user = Session::get_session(new User());
$logged_in = !empty($user);



require("common/php/php-head.php"); ?>

<main>

    <div class="slider mt-50 inactive" >
        <div class="container">

            <div class="pb-50 border-b pos-relative">
                
                <div class="swiper-nav">
                    <a href="#" class="next-btn" id="swiper-button-next"><i class="ion-ios-arrow-thin-right"></i></a>
                    <a href="#" class="prev-btn" id="swiper-button-prev"><i class="ion-ios-arrow-thin-left"></i></a>
                </div>
                
                <div class="swiper-container" id="featured-album">
                    <div class="swiper-wrapper">

                    </div>
                </div>
            </div>

        </div><!--container-->
    </div><!--slider-->

    
    <section class="section inactive">
        <div class="container">
            <div class="pb-20 border-b">
                <div class="oflow-hidden mb-20">
                    <h4 class="float-l mb-10">Newest Track</h4>
                    <a data-page="tracks" data-title="Track" href="track.php" class="not-load link mb-10 float-r"><b>View All</b></a>
                </div>
                <div id="slider-tracks" class="pos-relative"></div>
            </div><!--pb-50 border-b-->
        </div><!--container-->
    </section>


    <section class="section inactive">
        <div class="container">
            <div class="pb-20 border-b">
                <div class="oflow-hidden mb-20">
                    <h4 class="float-l mb-10">Recent Albums</h4>
                    <a data-page="album" data-title="Album" href="album.php" class="not-load link mb-10 float-r"><b>View All</b></a>
                </div>
                <div id="recent-albums" class="row"></div>
            </div><!--pb-20 border-b-->
        </div><!--container-->
    </section>


    <section class="section inactive">
        <div class="container">
            <div class="pb-20 border-b">
                <div class="oflow-hidden mb-20">
                    <h4 class="float-l mb-10">Popular Artists</h4>
                    <a data-page="artist" data-title="Album" href="artist.php" class="not-load link mb-10 float-r"><b>View All</b></a>
                </div>
                <div id="popular-artists" class="row"></div>
            </div><!--pb-20 border-b-->
        </div><!--container-->
    </section>

    <section class="section inactive">
        <div class="container">
            <div class="pb-20 border-b">
                <div class="oflow-hidden mb-20">
                    <h4 class="float-l mb-10">Featured Playlists</h4>
                    <!--<a data-page="playlist" data-title="Playlist" href="playlist.php" class="not-load link mb-10 float-r"><b>View All</b></a>-->
                </div>
                <div id="featured-playlists" class="row"></div>
            </div><!--pb-20 border-b-->
        </div><!--container-->
    </section>


    <section class="section inactive">
        <div class="container">
            <div class="pb-20">
                <div class="oflow-hidden mb-20">
                    <h4 class="float-l mb-10">Popular Playlists</h4>
                </div>
                <div id="popular-playlists" class="row"></div>
            </div><!--pb-20 border-b-->
        </div><!--container-->

    </section>


    <?php echo "<script>currentAction = '" .  MAIN_ACTION  . "'</script>"; ?>

    <script>var paginationElem = '#popular-playlists',
            pagination = 1,
            featuredPage = pagination,
            reachAtTheEnd = false;
    </script>
</main>


<?php require("common/php/php-footer.php"); ?>



<script>

    /*MAIN SCRIPTS*/
    
    (function ($) {
        "use strict";
        
        loadHomePage(pagination);

        $(window).on('scroll', function(e){

            if(!reachAtTheEnd){
                if (($(paginationElem).offset().top + $(paginationElem).height()) < ($(window).scrollTop() + $(window).height())){
                    pagination++;

                    loadHomePage(pagination);
                    
                }
            }
        });

    })(jQuery);

</script>

</body>

</html>

