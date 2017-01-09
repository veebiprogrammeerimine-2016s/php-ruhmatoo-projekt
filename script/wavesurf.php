
<script src="https://cdnjs.cloudflare.com/ajax/libs/wavesurfer.js/1.2.3/wavesurfer.min.js"></script>

<div id="waveform"></div>

<p align="center">
  <button class="btn btn-success" onclick="wavesurfer.playPause()">
    <i class="glyphicon glyphicon-play"></i>
    Play
  </button>
</p>

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