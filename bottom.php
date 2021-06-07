<!-- Footer -->
<footer style="background-color: #132c33;" class="w3-container w3-padding-64 w3-center">  
  <div class="w3-xlarge w3-padding-32">
    <i style="color: white; padding: 7px; "  class="fa fa-facebook-official"></i>
    <i style="color: white; padding: 7px;" class="fa fa-instagram"></i>
    <i style="color: white; padding: 7px;" class="fa fa-snapchat"></i>
    <i style="color: white; padding: 7px;" class="fa fa-pinterest-p"></i>
    <i style="color: white; padding: 7px;" class="fa fa-twitter"></i>
    <i style="color: white; padding: 7px;" class="fa fa-linkedin"></i>
 </div>
 <p style="color: white; padding: 7px;" >Powered by <a  style="text-decoration: none;"  href="https://md4ksanalytics.com" target="_blank">MD4KS Analytics Pvt. Ltd</a></p>
</footer>
    <script>
        // slider
        var slideIndex = 0;
        showSlides();

        function showSlides() {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            var dots = document.getElementsByClassName("dot");
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slideIndex++;
            if (slideIndex > slides.length) { slideIndex = 1 }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active";
            setTimeout(showSlides, 2000); // Change image every 2 seconds
        }

        // Used to toggle the menu on small screens when clicking on the menu button
        function myFunction() {
            var x = document.getElementById("navDemo");
            if (x.className.indexOf("w3-show") == -1) {
                x.className += " w3-show";
            } else {
                x.className = x.className.replace(" w3-show", "");
            }
        }
    </script>
</body>
</html>
