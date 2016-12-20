<script src="https://cdnjs.cloudflare.com/ajax/libs/wavesurfer.js/1.2.3/wavesurfer.min.js"></script>
					<div id="waveform">
					<script>
					var wavesurfer = WaveSurfer.create({
					container: '#waveform',
					waveColor: '#147A13',
					barWidth: 3,
					progressColor: 'darkpurple',
					splitChannels: false,
					height: 64
					});

					wavesurfer.load('');
					</script>
					</div>
					<p align="left">
					  <button class="btn btn-primary" onclick="wavesurfer.playPause()">
						<i class="glyphicon glyphicon-play"></i>
						Play
					  </button>
					</p>