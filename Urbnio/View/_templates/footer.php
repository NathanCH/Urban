        <footer>
            <div class="copyright">urbn.io &copy; 2014</div>
            <a href="http://github.com/NathanCH/urban" class="github">View source.</a>
            <?php //echo "Mem: ".memory_get_usage()." bytes <br />" ; ?>
            <?php //echo "Peak Mem: ".memory_get_peak_usage()." bytes" ; ?>
        </footer>
        <script src="<?= JS_PATH; ?>/functions.js"></script>
        <script src="<?= JS_PATH; ?>/components.js"></script>
        <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-9245624-4', 'urbn.io');
        ga('require', 'linkid', 'linkid.js');
        ga('require', 'displayfeatures')
        ga('send', 'pageview');
        </script>
    </body>
</html>