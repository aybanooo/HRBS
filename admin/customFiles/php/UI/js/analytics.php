<?php 

require_once(dirname(__FILE__, 3)."/directories/directories.php");

$trackingID = parse_ini_file(__CONF_PRIVATE__)['ANALYTICS_TRACKING_ID'];

?>

<!-- Google Analytics -->
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

ga('create', "<?php print $trackingID;?>", 'none');
ga('send', 'pageview');
</script>
<!-- End Google Analytics -->