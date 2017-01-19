
<script src="https://cdnjs.cloudflare.com/ajax/libs/wavesurfer.js/1.2.3/wavesurfer.min.js"></script>

<div id="waveform"></div>

<p align="center">
  <button class="button button2" onclick="wavesurfer.playPause()">
    <i class="glyphicon glyphicon-play"></i>
    Play
  </button>
  <button type="button" class="button button1" data-toggle="modal" data-target="#modal-1">Comment</button>
				<div class="modal fade" id="modal-1">
					<div class="modal-dialog modal-md">
						<div class="modal-content">
							 <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>						
							</div>
							<div class="modal-body">
								<center>
								<h2>Comment</h2>
						
								test
									
								</form>
								</center>
							</div>

							<div class="modal-footer">
								<a href="" class="btn btn-default" data-dismiss="modal">Close</a>						
							</div>
						</div>
					</div>
				</div>
</p>
<style>
.button {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 5px 12px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 2px 20px;
    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.8s;
    cursor: pointer;
}

.button1 {
    background-color: #4CAF50; 
    color: black; 
    border: 2px solid #4CAF50;
	border-radius: 6px;
}

.button1:hover {
    background-color: #6ad187;
    color: white;
}

.button2 {
    background-color: #3565ad; 
    color: black; 
    border: 2px solid #3565ad;
	border-radius: 6px;
}

.button2:hover {
    background-color: #6a93d1;
    color: white;
}
</style>
<script>
var wavesurfer = WaveSurfer.create({
  container: '#waveform',
  waveColor: '#004d00',
  progressColor: '#330033',
  barWidth: 3,
  splitChannels: false,
  height: 64
});

wavesurfer.load('<?php echo $sound; ?>');
</script>