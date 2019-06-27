$(function(){

  // Adjust Carousel Of Gallery
  $(document).on('click','.carousel.gallery',function(){
    var carID = $("#" + $(this).attr("id") );
    $(carID).on('slid.bs.carousel',function() {
      getPreviews(carID);
    });
  });
  $(document).on('mouseenter','.carousel.gallery',function(){
    var carID = $("#" + $(this).attr('id') );
    getPreviews(carID);
  });
  function getPreviews(id) {
    var nextImage =  $(id).find('.carousel-item.active').find('.next-preview').data('image');
    var prevImage =  $(id).find('.carousel-item.active').find('.prev-preview').data('image');
    $(id).find('.carousel-control-next').find('.preview-image').css('background-image','url('+nextImage+')');
    $(id).find('.carousel-control-prev').find('.preview-image').css('background-image','url('+prevImage+')');
  }

  // Adjust Load More in Home
  $(document).on('click','.sunset-load-more',function(e){
    e.preventDefault();
    var page = $(this).data('page'),
        ajaxurl = $(this).data('url'),
        newPage = page + 1,
        that = $(this),
        prev = that.data('prev'),
        archive = that.data('archive');

    if( typeof prev === 'undefined'){
      prev = 0;
    }
    if( typeof archive === 'undefined'){
      archive = 0;
    }
    that.addClass('loading').find('.text').slideUp(320);
    that.find('.sunset-icon').addClass('spin');
    // Start Ajax Call
    $.ajax({
        url : ajaxurl,
        type : 'post', // The Default Method of send data ( Post not Get )
        data : {
          page : page,
          prev : prev,
          archive : archive,
          action : 'sunset_load_more', // Php Funtion
        },
        error : function(response){
          console.log(response);
        },
        success: function(response){
          if(response == 0){ // No more Posts
            that.slideUp(320);
            return;
          }
          if(prev == 1){
            $('.posts-container').prepend(response);
            newPage = page - 1;
          }else{
            $('.posts-container').append(response);
          }
          if(newPage==1){
            that.slideUp(320);
          }
          that.data('page',newPage);
          setTimeout(function(){
            that.removeClass('loading').find('.text').slideDown(320);
            that.find('.sunset-icon').removeClass('spin');
          }, 2000)
          revealPosts();
        }
    });
  })

  // Function To add Reveal Class To Posts
  function revealPosts(){
      var posts = $('article:not(.reveal)'),
          i = 0;
      setInterval(function(){
        $(posts[i]).addClass('reveal').find('.carousel.gallery').carousel();
        i++;
      },200)
    }

  // Adjust Paging Url in Home Page
  $(window).on('scroll',function(){
      var scrollTop = $(window).scrollTop();
       $('.page-limit').each(function(){
         var elTop = $(this).offset().top,
             elHeight = $(this).height(),
             elBottom = elHeight + elTop;
          if( scrollTop >= elTop && scrollTop <= elBottom ){
            history.replaceState(null, null, $(this).data('limit'));
            return(false);
          }
      });
  })

<<<<<<< Updated upstream
=======
  // Adjust Siebar
  $(document).on('click','.js-toggleSidebar',function(){
    $('.sunset-sidebar').toggleClass('closed-sidebar');
    $('body').toggleClass('no-scroll');
    $('.sidebar-overlay').fadeToggle(320);
  });

>>>>>>> Stashed changes
})
