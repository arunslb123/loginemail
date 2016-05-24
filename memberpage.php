<?php require('includes/config.php'); 

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); } 

echo "checkechkechke";


if(isset($_POST['submitvideo'])){

	echo "checkooooo";

	try{



$videoid = $_POST['youtubelink'];
$apikey = 'AIzaSyC_CL8D4U0BV3Ng5_rIdUZ6aoA0gfNggoI';

$json = file_get_contents('https://www.googleapis.com/youtube/v3/videos?id='.$videoid.'&key='.$apikey.'&part=snippet');
$ytdata = json_decode($json);

$interval = new DateInterval($ytdata['duration']);

$duration = $interval->h * 3600 + $interval->i * 60 + $interval->s;


// echo '<h1>Title: ' . $ytdata->items[0]->snippet->title . '</h1>';
// echo 'Description: ' . $ytdata->items[0]->snippet->description;

		$stmt = $db->prepare('INSERT INTO users (name,age,email) VALUES (:password, :email, :active)');
			$stmt->execute(array(
				':password' => $ytdata->items[0]->snippet->title,
				':email' => $duration,
				':active' => 'aruncsheckff@ch.com'
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
               padding-top: 80px;
           }
           #trailer .modal-dialog {
               margin-top: 200px;
               width: 480px;
               height: 480px;
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

	    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
			
				<h2>Member only page - Welcome <?php echo $_SESSION['username']; ?></h2>
				<p><a href='logout.php'>Logout</a></p>
				<hr>

		</div>
	</div>
  
    <div class="row">
      <div class="col-xs-3 col-xs-offset-1">
      <center><h1><span style="color:#a62100"> You</span>Save </h1> </center>
      </div>
      <div class="col-xs-6 text-right">
       Howdy, Arun Prakash!
      </div>
      </div>


      <form role="form" method="post" action="" autocomplete="off">
      <div class="row">
      <div class="col-xs-6 col-xs-offset-2">
    <!--   <input type="text" class="form-control" id="youtubelink" placeholder="Enter your favorite youtube video url"> -->

    <input type="text" name="youtubelink" id="youtubelink" class="form-control" placeholder="Enter your favorite youtube video url" >



      </div>
      <div class="col-xs-4">


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
