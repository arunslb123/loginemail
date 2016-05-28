<?php require('includes/config.php'); 

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); } 




if(isset($_POST['submitvideo'])){


	try{



$link = $_POST['youtubelink'];


$videoid = explode("?v=", $link); // For videos like http://www.youtube.com/watch?v=...
if (empty($videoid[1]))
    $videoid = explode("/v/", $link); // For videos like http://www.youtube.com/watch/v/..

$videoid = explode("&", $videoid[1]); // Deleting any other params
$videoid = $videoid[0];





$apikey = 'AIzaSyC_CL8D4U0BV3Ng5_rIdUZ6aoA0gfNggoI';

$json = file_get_contents('https://www.googleapis.com/youtube/v3/videos?id='.$videoid.'&key='.$apikey.'&part=snippet');
$json2 = file_get_contents('https://www.googleapis.com/youtube/v3/videos?id='.$videoid.'&key='.$apikey.'&part=contentDetails');
$ytdata = json_decode($json);
$ytdata2 =json_decode($json2);



$duration = $ytdata2->items[0]->contentDetails->duration;
$interval = new DateInterval($duration);
$durationsec = $interval->h * 3600 + $interval->i * 60 + $interval->s;
$durationsec = $durationsec/60;

$description = $ytdata->items[0]->snippet->title;

$descriptionlength = strlen($description);

if($descriptionlength>15){
  $description = substr($description, 0, 15);
}

// echo '<h1>Title: ' . $ytdata->items[0]->snippet->title . '</h1>';
// echo 'Description: ' . $ytdata->items[0]->snippet->description;
// INSERT into urls ('url','userName','description','duration','inserttime')values('BNeXlJW70KQ','arun','desc1',28,now());


		$stmt = $db->prepare('INSERT INTO urls (url,userName,description,duration,inserttime) VALUES (:url, :userName, :description, :duration, now())');
			$stmt->execute(array(
				':url' => $videoid,
				':userName' => $_SESSION['username'] ,
				':description' => $description."...",
				':duration' => $durationsec
			));


	
		} catch(PDOException $e) {
		    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
		}

	

	}

//define page title
$title = 'Members Page';

//include header template
require('layout/header.php'); 
?>


 <style type="text/css" media="screen">
           body {
               padding-top: 10px;
           }
           #trailer .modal-dialog {
               margin-top: 200px;
               width: 800px;
               height: 600px;
           }
           .hanging-close {
               position: absolute;
               top: -12px;
               right: -12px;
               z-index: 9001;
           }
           #trailer-video {
               width: 100%;
               height: 100%;
           }
           .movie-tile {
               margin-bottom: 20px;
               padding-top: 20px;
           }
           .movie-tile:hover {

               cursor: pointer;
               background-color: #1FDA9A;

           }
           .scale-media {
               padding-bottom: 56.25%;
               position: relative;
           }
           .scale-media iframe {
               border: none;
               height: 100%;
               position: absolute;
               width: 100%;
               left: 0;
               top: 0;
               background-color: white;
           }
       </style>

       <script type="text/javascript" charset="utf-8">
              // Pause the video when the modal is closed
              $(document).on('click', '.hanging-close, .modal-backdrop, .modal', function (event) {
                  // Remove the src so the player itself gets removed, as this is the only
                  // reliable way to ensure the video stops playing in IE
                  $("#trailer-video-container").empty();
              });
              // Start playing the video whenever the trailer modal is opened
              $(document).on('click', '.movie-tile', function (event) {
                  var trailerYouTubeId = $(this).attr('data-trailer-youtube-id')
                  var sourceUrl = 'https://www.youtube.com/embed/' + trailerYouTubeId + '?autoplay=1&html5=1';
                  $("#trailer-video-container").empty().append($("<iframe></iframe>", {
                    'id': 'trailer-video',
                    'type': 'text-html',
                    'src': sourceUrl,
                    'frameborder': 0
                  }));
              });
              // Animate in the movies when the page loads
              $(document).ready(function () {
                $('.movie-tile').hide().first().show("fast", function showNext() {
                  $(this).next("div").show("fast", showNext);
                });
              });






          </script>





  </head>
  <body>
     <div class="modal" id="trailer">
    <div class="modal-dialog">
      <div class="modal-content">
        <a href="#" class="hanging-close" data-dismiss="modal" aria-hidden="true">
          <img src="https://lh5.ggpht.com/v4-628SilF0HtHuHdu5EzxD7WRqOrrTIDi_MhEG6_qkNtUK5Wg7KPkofp_VJoF7RS2LhxwEFCO1ICHZlc-o_=s0#w=24&h=24"/>
        </a>
        <div class="scale-media" id="trailer-video-container">
        </div>
      </div>
    </div>
  </div>




	





    <div class="container-fluid">

    <div class="row">

    <div class="col-xs-9 col-xs-offset-1">
    <h4>Howdy, <?php echo $_SESSION['username']; ?></h4>
    </div>

    <div class="col-xs-2">
      <p><a href='logout.php'>Logout</a></p>
    </div>

	</div>
  
    <div class="row">
      <div class="col-xs-9 col-xs-offset-1 col-md-9 col-md-offset-1 col-sm-9 col-sm-offset-1">
       <div class="logo"><center><h1><span style="color:white"> You<span style="color:#188fff">Save </h1> </center></span></div>
      </div>
      
      </div>


      <form role="form" method="post" action="" autocomplete="off">
      <div class="row">
      <div class="col-xs-8 col-xs-offset-1 col-lg-6 col-lg-offset-1 big-width">
    <!--   <input type="text" class="form-control" id="youtubelink" placeholder="Enter your favorite youtube video url"> -->

    <input type="text" name="youtubelink" id="youtubelink" class="form-control" placeholder="Enter your favorite youtube video url" >



      </div>
      <div class="col-xs-3 col-lg-3">


        <input type="submit" name="submitvideo" value="Save it" class="btn btn-danger btn-color">
      </div>
      <br><br><br><br>
      </div>
      </form>


        <div class="row " id="filters">
        <div class="col-xs-8 col-xs-offset-2">

        <div class="col-md-3 customcheckbox">
          <input type="checkbox" value=".first" name="first" id="first" />
          <label for="squaredOne"> 1-5 mins</label>
        </div>

         <div class="col-md-3 customcheckbox">
          <input type="checkbox" value=".second" id="second" name="second" />
          <label for="squaredOne"> 6-10 mins</label>
        </div>

         <div class="col-md-3 customcheckbox">
          <input type="checkbox" value=".third" id="third" name="third" />
          <label for="squaredOne"> 11-20 mins</label>
        </div>

         <div class="col-md-3 customcheckbox">
          <input type="checkbox" value=".fourth" id="fourth" name="fourth" />
          <label for="squaredOne"> >20 mins</label>
         </div>
      </div>
      <br><br><br><br><br><br><br>
      </div>





      </div>
      <div class="row-fluid displayvideo" id="displayvideo">



      </div>


<?php 
//include header template
require('layout/footer.php'); 
?>
