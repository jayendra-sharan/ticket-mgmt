$(document).ready(function() {

$('.nav-links').on('click', 'li', function() {
  console.log("click");
    $('.nav-links li.active').removeClass('active');
    $(this).addClass('active');
});



  $(".category").attr("required", "required");
  $(".category").change(function (){
    var val = $('.category').val();
    var xyz = $('#types option').filter(function() {
                  return this.value == val;
              }).data('value');

    $("#category-hidden").val(xyz);
  }); 

  $("#plus").on("click", function(){

    var count = $("#count").val();
    count = (parseInt(count) + 1);
    $("#count").val(count);
  });

   $("#minus").on("click", function(){

    var count = $("#count").val();
    if (parseInt(count) > 1){
      count = (parseInt(count) - 1);
      $("#count").val(count);
    }
  });

   
   $('.error').hide();
   $('.wrong-incident').hide();
   $('.any-other').hide();
  

    function check(e){
      if(!e.checkValidity()){
        
      }
      return true;
    }

   var num_isfilled = true;
   var user_isfilled = true;
   var desc_isfilled = true;
   function dis_submit(){
    $(".ticket-count-submit").attr('disabled','disabled');
    $(".ticket-count-submit").addClass('isdisabled');
   }
   function en_submit(){
    $(".ticket-count-submit").removeAttr('disabled');
    $(".ticket-count-submit").removeClass('isdisabled');
   }
    
   dis_submit();
   var count = 0;
   $('#error-num').hide();
   $('#error-user').hide();
   $('#error-desc').hide();
   $('.category').focusin(function(){
    $('.wrong-incident').hide();
    $('.error').hide();
    $('.any-other').hide();

   });
   $('.category').on("keypress", function(){
    en_submit();
   })
   $('.category').focusout(function(){

      var input = this.value;
      if(input.length < 1){
        $('.error').show();
        dis_submit();
  
      }else if (input.indexOf("Wrongly Reported") == 0){
        $('.error').hide();
        $('.wrong-incident').show();
        $('label[for=count]').hide();
        $('.modify').hide();
        dis_submit();
        $('.inc-num').focus();
        $('#error-num').hide();
        $('.inc-num').focusin(function(){
          $('#error-num').hide();
        });
        $('.inc-num').focusout(function(){
            var input = this.value;
            if(input.length < 1){
              $("#error-num").show();
               dis_submit();
            }else{
              $('#error-num').hide();
           
            }
        });
        $('.inc-user').focusin(function(){
          $('#error-user').hide();
        });
        $('.inc-user').focusout(function(){
           var input = this.value;
            if(input.length < 1){
              $("#error-user").show();
               dis_submit();
            }else{
              $('#error-user').hide();
             
              $('#error-desc').hide();
           
            } 
        })
        $('.inc-desc').focusin(function(){
          $('#error-desc').hide();
        });
        $('.inc-desc').focusout(function(){
            var input = this.value;
            if(input.length < 1){
              $("#error-desc").show();
               dis_submit();
            }else{
              $('#error-desc').hide();
              en_submit();
            
            } 
        });
      } else if (input.search(/Any Other/i) >= 0) {
        dis_submit();
        $('.any-other').show();
        $('#error-ao-desc').hide();
        $('label[for=count]').hide();
        $('.modify').hide();
        $('input[name=ao-desc]').focus();
        
        $('.ao-desc').focusin(function(){
          $('#error-ao-desc').hide();
        });
        
        $('.ao-desc').focusout(function(){
            var input = this.value;
            if(input.length < 1){
              $("#error-ao-desc").show();
               dis_submit();
            }else{
              $('#error-ao-desc').hide();
              en_submit();
             
            } 
        });
      }else{
        $('label[for=count]').show();
        $('.modify').show();
        $('.wrong-incident').hide();
        $('.any-other').hide();
        en_submit();
      }
    });

  function checkScroll(){
    var height = $('.navbar').height();
    var startY = 0;
    if (height <= 115) {
      startY = $('.navbar').height() * 4; //The point where the navbar changes in px
    }else {
      startY = $('.navbar').height() * 2;
    }

    if($(window).scrollTop() > startY){
        $('.navbar').addClass("scrolled");
    }else{
        $('.navbar').removeClass("scrolled");
    }
  }

if($('.isindex').length > 0 && $('.navbar').length > 0) {
    $(window).on("scroll load resize", function(){
        checkScroll();
    });
}


//JQuery for ticket memebers

$(".user-details").on("click", function(){
  $('.user-details').removeClass('current');
  $('.count-details').hide();
  var div = $(this);
  console.log(div);
  $(this).addClass('current');
  $(this).children('.count-details').fadeToggle("slow");

})








});