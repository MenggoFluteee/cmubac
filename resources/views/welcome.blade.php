<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('images/cmulogo.png') }}">
    <link rel="stylesheet" href="{{ asset('css/landing_page.css') }}">
    {{-- Box Icons --}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css">

    <title>CMU | ProcureNet</title>
</head>

<body>
    {{-- Navbar --}}
    <header>
        <a href="#" class="logo"><img src="{{ asset('images/cmulogo.png') }}" alt="cmu logo"><span>Central
                Mindanao
                University</span></a>
        <div class="bx bx-menu" id="menu-icon"></div>

        <ul class="navbar">
            <li><a href="#home">Home</a></li>
            <li><a href="#achievements">Achievements</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
            <li><a href="{{ route('login') }}">Login</a></li>
        </ul>
    </header>

    <section class="home" id="home">
        <div class="home-text">
            <span>Welcome to</span>
            <h1>ProcureNet</h1>
            <h2>A Budget and Procurement Management System</h2>
            <p>of CMU Bids and Awards Committee</p>
            <a href="{{ route('login') }}" class="btn">Login</a>
        </div>
        <div class="home-img">
            <img src="{{ asset('images/oupd-Logo.png') }}" alt="OSA logo">
        </div>
    </section>
    <div class="achievement-overlay">
        <section class="achievements" id="achievements">
            <div class="achievements-heading">
                <span>Department's</span>
                <h1>ACHIEVEMENTS</h1>
            </div>
            <div class="achievements-container">
                <div class="box">
                    <div class="box-img">
                        <img src="{{ asset('images/oupd-Logo.png') }}" alt="">
                    </div>

                    <h2>ISO 9001:2015 Certified</h2>

                    <a href="#" class="btn">Order Now</a>
                </div>
                <div class="box">
                    <div class="box-img">
                        <img src="{{ asset('images/oupd-Logo.png') }}" alt="">
                    </div>

                    <h2>ISO 9001:2015 Certified</h2>

                    <a href="#" class="btn">Order Now</a>
                </div>
                <div class="box">
                    <div class="box-img">
                        <img src="{{ asset('images/oupd-Logo.png') }}" alt="">
                    </div>

                    <h2>ISO 9001:2015 Certified</h2>

                    <a href="#" class="btn">Order Now</a>
                </div>
            </div>
        </section>
    </div>



    <section class="about" id="about">
        <div class="about-heading">
            <span>Department's</span>
            <h1>Mission and Vision</h1>
        </div>
        <div class="container">
            <div class="about-img">
                <img src="{{ asset('images/cmupic.jpg') }}" alt="">
            </div>
            <div class="about-text">
                <h2>MISSION</h2>
                <p>To advance the frontier of knowledge through internationalization of education and equitable access
                    to quality instruction, research, extension and production for economic prosperity, moral integrity,
                    social and cultural sensitivity and environmental consciousness.</p>

            </div>
        </div>
        <div class="container">
            <div class="about-text">
                <h2>VISION</h2>
                <p>A leading ASEAN university actively committed to the total development of people for a globally
                    sustainable environment and a humane society.</p>


            </div>
            <div class="about-img">
                <img src="{{ asset('images/cmupic.jpg') }}" alt="">
            </div>

        </div>
    </section>

    <section class="contact" id="contact">
        <div class="social">
            <a href="#"><i class="bx bxl-twitter"></i></a>
            <a href="#"><i class="bx bxl-facebook"></i></a>
            <a href="#"><i class="bx bxl-instagram"> </i></a>
        </div>
        <div class="links">
            <a href="#">Privacy Policy</a>
            <a href="#">Terms of Use</a>
            <a href="#">Our Company</a>
        </div>
        <p>
            &#169; Software Development Department OJT-2024. All Rights Reserved.
        </p>
    </section>

</body>

</html>
