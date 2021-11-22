<?php
include("header.php");
?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
    </ol>
</nav>
<section class="mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <form id="message_box">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="example@gmail.com"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Message</label>
                        <textarea class="form-control" id="msg" rows="3" name="message" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit" id="submit_button">Submit</button>
                </form>
                <!-- <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                </div> -->
                <div id="show" class="text-success">

                </div>
            </div>
            <div class="col-md-5 mt-2">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d59259.141703528396!2d75.57835752673607!3d21.830659861983513!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bd885c4bd93b163%3A0xae95ec27b40bf31d!2sKhargone%2C%20Madhya%20Pradesh%20451001!5e0!3m2!1sen!2sin!4v1630151549354!5m2!1sen!2sin"
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="js/custom.js"></script>
<?php
include("footer.php");
?>