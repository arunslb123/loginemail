



var excc=function(){
    var $container = $('#displayvideo'),
      $checkboxes = $('#filters input');
      console.log($checkboxes)

  $container.isotope({
    itemSelector: '.bgvideo'
  });
  // get Isotope instance
  var isotope = $container.data('isotope');
  // add even classes to every other visible item, in current order
  function addEvenClasses() {
    isotope.$filteredAtoms.each( function( i, elem ) {
      $(elem)[ ( i % 2 ? 'addClass' : 'removeClass' ) ]('even')
    });
  }

  $checkboxes.change(function(){
    var filters = [];
    // get checked checkboxes values
    $checkboxes.filter(':checked').each(function(){
      filters.push( this.value );
    });
    // ['.red', '.blue'] -> '.red, .blue'
    filters = filters.join(', ');
    $container.isotope({ filter: filters });
    addEvenClasses();
  });

  $('#shuffle').click(function(){
    $container.isotope('shuffle');
    addEvenClasses();
  });
}




$( document ).ready(function() {
	console.log("hel")
    function login_click() 
{
    window.location.href = "/home.html";
};
});




$(document).ready(function () {


    $.ajax({
            type: 'GET',
            //url: 'https://script.google.com/macros/s/AKfycbwTQEEWxi6g2Z7W6KgqiM9hd7hl2MHnQ_OVjjidLh3jYLpU-qM/exec',
            url:'/getVideoDetails.php',
            dataType: 'json',
            success: function(data){
               // var jsondata = $.parseJSON(data);
                // $('#desktop').append('<div id="jsoninfo">Data loaded.</div>');
                // var myicons = jsondata['myicons'];
                // $.each(myicons, function() {
                //     alert('found!');
                for(var i=0;i<data.songjson.length;i++){

                   if(data.songjson[i].time<=5){

                                  $("#displayvideo").append(
                        '<div class="col-md-6 col-lg-4 movie-tile text-center col-centered bgvideo first" data-trailer-youtube-id="' + data.songjson[i].url + '" data-toggle="modal" data-target="#trailer">' + 
                            '<img src="http://img.youtube.com/vi/' + data.songjson[i].url + '/0.jpg" width="100" height="100">' +
                            '<h4>' + data.songjson[i].title + '</h4>' + 
                        '</div>'
                    );
                                  console.log("check")


                   }

                   if(data.songjson[i].time>5 && data.songjson[i].time<=10){

                                      $("#displayvideo").append(
                        '<div class="col-md-6 col-lg-4 movie-tile text-center col-centered bgvideo second" data-trailer-youtube-id="' + data.songjson[i].url + '" data-toggle="modal" data-target="#trailer">' + 
                            '<img src="http://img.youtube.com/vi/' + data.songjson[i].url + '/0.jpg" width="100" height="100">' +
                            '<h4>' + data.songjson[i].title + '</h4>' + 
                        '</div>'
                    );


                   }

                    if(data.songjson[i].time>10 && data.songjson[i].time<=20){


                                      $("#displayvideo").append(
                        '<div class="col-md-6 col-lg-4 movie-tile text-center bgvideo col-centered third" data-trailer-youtube-id="' + data.songjson[i].url + '" data-toggle="modal" data-target="#trailer">' + 
                            '<img src="http://img.youtube.com/vi/' + data.songjson[i].url + '/0.jpg" width="100" height="100">' +
                            '<h4>' + data.songjson[i].title + '</h4>' + 
                        '</div>'
                    );


                   }

                    if(data.songjson[i].time>20){


                                      $("#displayvideo").append(
                        '<div class="col-md-6 col-lg-4 movie-tile text-center col-centered bgvideo fourth" data-trailer-youtube-id="' + data.songjson[i].url + '" data-toggle="modal" data-target="#trailer">' + 
                            '<img src="http://img.youtube.com/vi/' + data.songjson[i].url + '/0.jpg" width="100" height="100">' +
                            '<h4>' + data.songjson[i].title + '</h4>' + 
                        '</div>'
                    );


                   }








   


                  
                  


      
                }


               $( "#but2" ).click(function() {
                  $(".displayvideo").empty();
                  for(var i=0;i<data.songjson.length;i++){
                       if(data.songjson[i].time<=5){

                                          $(".displayvideo").append(
                            '<div class="col-md-6 col-lg-4 movie-tile text-center bgvideo" data-trailer-youtube-id="' + data.songjson[i].url + '" data-toggle="modal" data-target="#trailer">' + 
                                '<img src="http://img.youtube.com/vi/' + data.songjson[i].url + '/0.jpg" width="220" height="250">' +
                                '<h4>' + data.songjson[i].title + '</h4>' + 
                            '</div>'
                        );



                       }
                  
                  
                  }


                 


               });



                $( "#but3" ).click(function() {
                  $(".displayvideo").empty();
                  for(var i=0;i<data.songjson.length;i++){
                       if(data.songjson[i].time>=5 && data.songjson[i].time<=10){

                                          $(".displayvideo").append(
                            '<div class="col-md-6 col-lg-4 movie-tile text-center bgvideo" data-trailer-youtube-id="' + data.songjson[i].url + '" data-toggle="modal" data-target="#trailer">' + 
                                '<img src="http://img.youtube.com/vi/' + data.songjson[i].url + '/0.jpg" width="220" height="250">' +
                                '<h4>' + data.songjson[i].title + '</h4>' + 
                            '</div>'
                        );



                       }
                  
                  
                  }


                 


               });




                 $( "#but4" ).click(function() {
                  $(".displayvideo").empty();
                  for(var i=0;i<data.songjson.length;i++){
                       if(data.songjson[i].time>=10 && data.songjson[i].time<=20){

                                          $(".displayvideo").append(
                            '<div class="col-md-6 col-lg-4 movie-tile text-center bgvideo" data-trailer-youtube-id="' + data.songjson[i].url + '" data-toggle="modal" data-target="#trailer">' + 
                                '<img src="http://img.youtube.com/vi/' + data.songjson[i].url + '/0.jpg" width="220" height="250">' +
                                '<h4>' + data.songjson[i].title + '</h4>' + 
                            '</div>'
                        );



                       }
                  
                  
                  }


                 


               });



                  $( "#but5" ).click(function() {
                  $(".displayvideo").empty();
                  for(var i=0;i<data.songjson.length;i++){
                       if(data.songjson[i].time>20){

                                          $(".displayvideo").append(
                            '<div class="col-md-6 col-lg-4 movie-tile text-center bgvideo" data-trailer-youtube-id="' + data.songjson[i].url + '" data-toggle="modal" data-target="#trailer">' + 
                                '<img src="http://img.youtube.com/vi/' + data.songjson[i].url + '/0.jpg" width="220" height="250">' +
                                '<h4>' + data.songjson[i].title + '</h4>' + 
                            '</div>'
                        );



                       }
                  
                  
                  }


                 


               });


  
                //$(#displayvideo).append(data)
                console.log(data);
                console.log("Success")
                //}
                


            },  
            error: function() {
                //$('#desktop').append('<div id="jsoninfo">Failed to load desktop.</div>');
                console.log("error")
            }   
        });



// $('.grid').isotope({
//   // options
//   itemSelector: '.displayvideo',
//   layoutMode: 'fitRows'
// });


});


$( "#filters" ).click(function() {
  excc();
});

$('.message a').click(function(){
   $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
});
