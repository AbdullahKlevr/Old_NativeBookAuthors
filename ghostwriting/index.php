<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("includes/compatibility.php"); ?>
    <meta name="description"
        content="Looking for a skilled ghostwriter? Our agency specializes in professional book ghostwriting services.">
    <title>Professional Book Ghostwriting Services | <?php echo $brand;?></title>
    <?php include("includes/style.php"); ?>
</head>

<body>

    <div class="mainBanner">
        <?php include("includes/header.php"); ?>
        <div class="container">
            <div class="banner-content">
                <div class="row align-items-center justify-content-center">
                    <div class="col-lg-11">
                        <h1 class="banner-heading">
                            Most Trusted <span>Ghostwriting Services </span> In The USA: <?php echo $brand;?>, Stringing Words Together to Redefine Storytelling
                        </h1>
                        <p class="banner-text">
                           Have a vision for a bestseller? Our book writing services will not disappoint!
                        </p>
                        <ul class="ban-list">
                            <li> Top-tier ebook writers</li>
                            <li>Quick turnaround time</li>
                            <li>End-to-end author assistance </li>
                            <li>100% satisfaction guaranteed</li>
                            <li>Packages for every budget</li>

                        </ul>
                        <form class="ban-form" action="/leads/" method="POST">
                        <input type="hidden" name="route" value="<?= $_SERVER['REQUEST_URI'] ?>">
<input type="hidden" name="brief" value="">
<input type="hidden" name="brand" value="NATIVEBOOKAUTHORS">
<input type="hidden" name="token" value="<?= $token; ?>">
<input type="hidden" name="tag" value="top-form">
<input type="hidden" name="price" value="null">
<input type="hidden" name="news" value="1">
           <input type="hidden" name="subject" value="Banner Form (nativebookauthors.com)">
                            <div class="row g-4">
                                <div class="col-lg-3">
                                    <input type="text" name="name" placeholder="Full Name" required>
                                </div>
                                <div class="col-lg-3">
                                    <input type="email" name="email" placeholder="Email" required>
                                </div>
                                <div class="col-lg-3">
                                    <input type="text" name="phone" placeholder="Phone" required>
                                </div>
                                <div class="col-lg-3">
                                    <button type="submit">Get a Free Quote</button>
                                </div>
                            </div>
                        </form>
                         <div id="countdown">
                                <ul>
                                    <li>HOURS<span id="hours"></span></li>

                                    <li>MINUTES<span id="minutes"></span></li>

                                    <li>SECONDS<span id="seconds"></span></li>
                                </ul>
                            </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="trusted-wrap">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="trusted">
                        <img src="ghostwriting/assets/images/trusted.webp" alt="" loading="lazy" width="100px" height="100px">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="counter-wrap goto">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="counter-list" id="counter">
                        <li>
                            <span class="count">200 </span><span>+</span>
                            <p>Bestsellers </p>
                        </li>
                        <li>
                            <span class="count">20 </span><span>+</span>
                            <p>NYT & WSJ Best Sellers</p>
                        </li>
                        <li>
                            <span class="count">60</span><span>+</span>
                            <p>Award-winning writers</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div> -->
    <section>
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-lg-6">
                    <div class="sec-heading">
                        <h2>
                            Turn Your Vision into a Bestseller!
                        </h2>
                        <p>
                            Writing a book is a form of art, one that requires time, effort, and, most importantly, patience. If you have an idea that can turn into a bestseller but don’t have the time, <?php echo $brand;?> brings you a team of the best ghost book writers in town, excelling in crafting engaging reads. Be it fiction, demanding elite world-building, or non-fiction, needing the brains of a subject-matter expert, we have a writer for every genre. 
                        </p>
                    </div>
                    <div class="btn-wrap">
                        <a href="javascript:;" class="theme-btn popstatic">Let’s Get Started</a>
                        <a href="javascript:;" class="theme-btn bordered ">
                            <?php echo $phone;?>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 text-md-end">
                    <img src="ghostwriting/assets/images/s1.webp" alt="" loading="lazy" width="100px" height="100px">
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="sec-heading center ">
                        <h2>Self-Publishing Made Easy, Simple, and Convenient</h2>
                        <p>
                            Ready to transition into a successful published author? <?php echo $brand;?> has everything you need to turn your dream into a reality of making it big as a published author!
                        </p>
                    </div>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="bordered-card">
                        <img src="ghostwriting/assets/images/icons/1.webp" alt="" loading="lazy" width="100px" height="100px">
                        <h3>Ghostwriting: Penning Perfection</h3>
                        <p>
                            We have the most trusted team that not only offers help writing a book but turns it into the ‘talk of the town.’ With an ebook writer for every genre possessing extensive experience, we have the expertise to turn your ideas into a well-written book that sells.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="bordered-card">
                        <img src="ghostwriting/assets/images/icons/2.webp" alt="" loading="lazy" width="100px" height="100px">
                        <h3>Book Editing: Touch of Finesse</h3>
                        <p>
                            Even if you have self-edited the book, you need to give that touch of finesse by running it through the eyes of a professional. From ensuring the proper placement of the chapters to addressing the smallest of errors, our team of editors will enhance a book’s quality manifold.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="bordered-card">
                        <img src="ghostwriting/assets/images/icons/3.webp" alt="" loading="lazy" width="100px" height="100px">
                        <h3>Book Publishing: Maximizing Reach </h3>
                        <p>
                            We know how crucial it is to get a book published on the right platforms at the right time. The publishing experts at <?php echo $brand;?> have the skills, tools, and capability to get your book published on the most popular global publishing platforms. 
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="bordered-card">
                        <img src="ghostwriting/assets/images/icons/4.webp" alt="" loading="lazy" width="100px" height="100px">
                        <h3>Book Marketing: Expanding Horizons</h3>
                        <p>
                            With decades of experience turning books into bestsellers through powerful marketing strategies, <?php echo $brand;?> offers every author to succeed in the publishing industry. From global syndicated coverage to social media marketing, our marketers don’t leave any stone unturned. 
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="bordered-card">
                        <img src="ghostwriting/assets/images/icons/5.webp" alt="" loading="lazy" width="100px" height="100px">
                        <h3>Book Design: Impressing with Aesthetics </h3>
                        <p>
                            Aesthetics plays a key role when publishing books. Regardless of what the world believes, people judge books by their covers. With our creative cover designers and illustrators, you can make your book sell well by impressing readers through captivating aesthetics. 
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="bordered-card">
                        <img src="ghostwriting/assets/images/icons/6.webp" alt="" loading="lazy" width="100px" height="100px">
                        <h3>Book Formatting: Visually Professional </h3>
                        <p>
                            One of the most innovative ways to make your book ‘credible’ is to give it the most professional look. While the book's substance is critical for success, perfection in formatting plays a significant role in the book’s overall look. Our professional formatters will help make your book enjoy the most elite look. 
                        </p>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="btn-wrap justify-content-center">
                        <a href="javascript:;" class="theme-btn popstatic">Let’s Get Started</a>
                        <a href="javascript:;" class="theme-btn bordered "><i class="fa fa-phone"></i>
                            <?php echo $phone;?></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-dark">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="sec-heading center white">
                        <h2>A Sneak Peek into Our Wonders!</h2>
                        <p>
                            Stop scrolling, and prepare to be swept off your feet by our strong portfolio, which makes us one of the country’s best writing companies! 
                        </p>
                    </div>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <a data-fancybox="gallery" href="ghostwriting/assets/images/portfolio/full/1.webp" tabindex="0"
                        class="portfolio">
                        <img src="ghostwriting/assets/images/portfolio/1.webp" alt="" loading="lazy" width="100px" height="100px">
                    </a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <a data-fancybox="gallery" href="ghostwriting/assets/images/portfolio/full/2.webp" tabindex="0"
                        class="portfolio">
                        <img src="ghostwriting/assets/images/portfolio/2.webp" alt="" loading="lazy" width="100px" height="100px">
                    </a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <a data-fancybox="gallery" href="ghostwriting/assets/images/portfolio/full/3.webp" tabindex="0"
                        class="portfolio">
                        <img src="ghostwriting/assets/images/portfolio/3.webp" alt="" loading="lazy" width="100px" height="100px">
                    </a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <a data-fancybox="gallery" href="ghostwriting/assets/images/portfolio/full/4.webp" tabindex="0"
                        class="portfolio">
                        <img src="ghostwriting/assets/images/portfolio/4.webp" alt="" loading="lazy" width="100px" height="100px">
                    </a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <a data-fancybox="gallery" href="ghostwriting/assets/images/portfolio/full/5.webp" tabindex="0"
                        class="portfolio">
                        <img src="ghostwriting/assets/images/portfolio/5.webp" alt="" loading="lazy" width="100px" height="100px">
                    </a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <a data-fancybox="gallery" href="ghostwriting/assets/images/portfolio/full/6.webp" tabindex="0"
                        class="portfolio">
                        <img src="ghostwriting/assets/images/portfolio/6.webp" alt="" loading="lazy" width="100px" height="100px">
                    </a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <a data-fancybox="gallery" href="ghostwriting/assets/images/portfolio/full/7.webp" tabindex="0"
                        class="portfolio">
                        <img src="ghostwriting/assets/images/portfolio/7.webp" alt="" loading="lazy" width="100px" height="100px">
                    </a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <a data-fancybox="gallery" href="ghostwriting/assets/images/portfolio/full/8.webp" tabindex="0"
                        class="portfolio">
                        <img src="ghostwriting/assets/images/portfolio/8.webp" alt="" loading="lazy" width="100px" height="100px">
                    </a>
                </div>

                <div class="col-lg-12">
                    <div class="btn-wrap justify-content-center">
                        <a href="javascript:;" class="theme-btn popstatic">Let’s Get Started</a>
                        <a href="javascript:;" class="theme-btn bordered white"><i class="fa fa-phone"></i>
                            <?php echo $phone;?></a>
                    </div>
                    <div class="rating">
                        We are rated 4.5
                        <span class="stars">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </span>
                        among 1000+ customers
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section>
        <div class="container">
            <div class="cta"  style="--cta:url('../images/cta.webp')no-repeat; --width:45%;">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="sec-heading white">
                            <h2>
                                Looking to Kickstart Your Journey to Becoming a Bestselling Author?
                            </h2>
                            <p>
                                <?php echo $brand;?> is your one-stop self-publishing solution. It offers the winning strategy for becoming a published author—a successful one at that! 
                            </p>
                        </div>
                        <div class="btn-wrap">
                            <a href="javascript:;" class="theme-btn popstatic">Get Started</a>
                            <a href="javascript:;" class="theme-btn white bordered" onclick="setButtonURL();">Live Chat</a>
                            
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="sec-heading center">
                        <h2>
                            Find Your Genre!
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-lg-12">
                    <ul class="overview-nav d2">
                        <li data-targetit="box-1" class=" active">
                            <a href="javascript:;">Romance</a>
                        </li>
                        <li data-targetit="box-2">
                            <a href="javascript:;">Science Fiction</a>
                        </li>
                        <li data-targetit="box-3">
                            <a href="javascript:;">Christianity</a>
                        </li>
                        <li data-targetit="box-4">
                            <a href="javascript:;">Educational</a>
                        </li>
                        <li data-targetit="box-5">
                            <a href="javascript:;">Travel</a>
                        </li>
                        <li data-targetit="box-6">
                            <a href="javascript:;">Health</a>
                        </li>
                        <li data-targetit="box-7">
                            <a href="javascript:;">Drama</a>
                        </li>
                        <li data-targetit="box-8">
                            <a href="javascript:;">Horror</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-12">
                    <div class="box-1 showfirst  port-content" style="display:block">
                        <div class="row g-4 align-items-center">
                            <div class="col-md-6">
                                <div class="sec-heading ">
                                    <h2>
                                        Partner with Writers that Live In Their Romantic Fantasies
                                    </h2>
                                    <p>
                                        Steaming hot scenes, offering just the right touch of drama, our romance ghostwriting service steals hearts, making readers ask for more! 
                                    </p>
                                </div>
                                <div class="btn-wrap">
                                    <a href="javascript:;" class="theme-btn popstatic">Get Started</a>
                                    <a href="javascript:;" class="theme-btn  bordered" onclick="setButtonURL();">Live Chat</a>
                                </div>
                            </div>
                            <div class="col-lg-4 offset-lg-2 col-md-6">
                                <img src="ghostwriting/assets/images/genres/1.webp" alt="" loading="eager" width="100px"
                                    height="100px">
                            </div>
                        </div>
                    </div>
                    <div class="box-2 port-content">
                        <div class="row g-4 align-items-center">
                            <div class="col-md-6">
                                <div class="sec-heading ">
                                    <h2>
                                        Prepare for Epic World Building with Sci-Fi Wizardry 
                                    </h2>
                                    <p>
                                        Be it realistic fiction or a ride into the world beyond, our sci-fi enthusiast lives in their sci-fi worlds, crafting the most compelling sci-fi stories!
                                    </p>
                                </div>
                                <div class="btn-wrap">
                                    <a href="javascript:;" class="theme-btn popstatic">Get Started</a>
                                    <a href="javascript:;" class="theme-btn  bordered" onclick="setButtonURL();">Live Chat</a>
                                </div>
                            </div>
                            <div class="col-lg-4 offset-lg-2 col-md-6">
                                <img src="ghostwriting/assets/images/genres/2.webp" alt="" loading="eager" width="100px"
                                    height="100px">
                            </div>
                        </div>
                    </div>
                    <div class="box-3 port-content">
                        <div class="row g-4 align-items-center">
                            <div class="col-md-6">
                                <div class="sec-heading ">
                                    <h2>
                                       Spread the Message Far and Wide with Our Christian Ghostwriters
                                    </h2>
                                    <p>
                                        Looking for Christian-faith-based ghostwriters to help you spread the message of righteousness? Look no further; <?php echo $brand;?>s has got your back. 
                                    </p>
                                </div>
                                <div class="btn-wrap">
                                    <a href="javascript:;" class="theme-btn popstatic">Get Started</a>
                                    <a href="javascript:;" class="theme-btn  bordered" onclick="setButtonURL();">Live Chat</a>
                                </div>
                            </div>
                            <div class="col-lg-4 offset-lg-2 col-md-6">
                                <img src="ghostwriting/assets/images/genres/3.webp" alt="" loading="eager" width="100px"
                                    height="100px">
                            </div>
                        </div>
                    </div>
                    <div class="box-4 port-content">
                        <div class="row g-4 align-items-center">
                            <div class="col-md-6">
                                <div class="sec-heading ">
                                    <h2>
                                       Let Our Subject-Matter Experts Help You Educate the World
                                    </h2>
                                    <p>
                                        Be it textbooks for high school or self-help books containing your survival secrets, we have the most skilled non-fiction ghostwriters who will help you hit your target.
                                    </p>
                                </div>
                                <div class="btn-wrap">
                                    <a href="javascript:;" class="theme-btn popstatic">Get Started</a>
                                    <a href="javascript:;" class="theme-btn  bordered" onclick="setButtonURL();">Live Chat</a>
                                </div>
                            </div>
                            <div class="col-lg-4 offset-lg-2 col-md-6">
                                <img src="ghostwriting/assets/images/genres/4.webp" alt="" loading="eager" width="100px"
                                    height="100px">
                            </div>
                        </div>
                    </div>
                    <div class="box-5 port-content">
                        <div class="row g-4 align-items-center">
                            <div class="col-md-6">
                                <div class="sec-heading ">
                                    <h2>
                                        Join Our Globetrotters As They Take Your Readers on a Trip
                                    </h2>
                                    <p>
                                       In search of travel enthusiasts who can pen your travel stories with perfection? From travel guides to destination-specific books, our writers will craft the most impressive travel books for your audience. 
                                    </p>
                                </div>
                                <div class="btn-wrap">
                                    <a href="javascript:;" class="theme-btn popstatic">Get Started</a>
                                    <a href="javascript:;" class="theme-btn  bordered" onclick="setButtonURL();">Live Chat</a>
                                </div>
                            </div>
                            <div class="col-lg-4 offset-lg-2 col-md-6">
                                <img src="ghostwriting/assets/images/genres/5.webp" alt="" loading="eager" width="100px"
                                    height="100px">
                            </div>
                        </div>
                    </div>
                    <div class="box-6 port-content">
                        <div class="row g-4 align-items-center">
                            <div class="col-md-6">
                                <div class="sec-heading ">
                                    <h2>
                                        Looking for a Healthcare Expert for Your Book?
                                    </h2>
                                    <p>
                                        Partner with our medical writers, who will help you write the most reliable books in the health genre, ensuring 100% authenticity. 
                                    </p>
                                </div>
                                <div class="btn-wrap">
                                    <a href="javascript:;" class="theme-btn popstatic">Get Started</a>
                                    <a href="javascript:;" class="theme-btn  bordered" onclick="setButtonURL();">Live Chat</a>
                                </div>
                            </div>
                            <div class="col-lg-4 offset-lg-2 col-md-6">
                                <img src="ghostwriting/assets/images/genres/6.webp" alt="" loading="eager" width="100px"
                                    height="100px">
                            </div>
                        </div>
                    </div>
                    <div class="box-7 port-content">
                        <div class="row g-4 align-items-center">
                            <div class="col-md-6">
                                <div class="sec-heading ">
                                    <h2>
                                        Ready for a Fully-Immersive Dramatic Tale?
                                    </h2>
                                    <p>
                                        We have ghostwriters on board who live and breathe drama, enabling them to craft the most powerful drama novels. 
                                    </p>
                                </div>
                                <div class="btn-wrap">
                                    <a href="javascript:;" class="theme-btn popstatic">Get Started</a>
                                    <a href="javascript:;" class="theme-btn  bordered" onclick="setButtonURL();">Live Chat</a>
                                </div>
                            </div>
                            <div class="col-lg-4 offset-lg-2 col-md-6">
                                <img src="ghostwriting/assets/images/genres/7.webp" alt="" loading="eager" width="100px"
                                    height="100px">
                            </div>
                        </div>
                    </div>
                    <div class="box-8 port-content">
                        <div class="row g-4 align-items-center">
                            <div class="col-md-6">
                                <div class="sec-heading ">
                                    <h2>
                                        Prepare For a Spine-Chilling Read that’ll Surely Scare You
                                    </h2>
                                    <p>
                                        Have an idea that can turn into a read that causes goosebumps? Partner with our horror-genre ghostwriters today. 
                                    </p>
                                </div>
                                <div class="btn-wrap">
                                    <a href="javascript:;" class="theme-btn popstatic">Get Started</a>
                                    <a href="javascript:;" class="theme-btn  bordered" onclick="setButtonURL();">Live Chat</a>
                                </div>
                            </div>
                            <div class="col-lg-4 offset-lg-2 col-md-6">
                                <img src="ghostwriting/assets/images/genres/8.webp" alt="" loading="eager" width="100px"
                                    height="100px">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-dark">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="sec-heading center white">
                        <h2>
                            Why <?php echo $brand;?>?
                        </h2>
                        <p>
                            Well, we don’t just claim we have the skills, expertise, and experience to make it happen for you.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="choose-card">
                        <img src="ghostwriting/assets/images/choose/1.webp" alt="" loading="eager" width="100px" height="100px">
                        <h3>
                            Diverse Portfolio
                        </h3>
                        <p>
                            Be it sci-fi or a self-help book, you will find every genre in our vast and diverse portfolio. 
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="choose-card">
                        <img src="ghostwriting/assets/images/choose/1.webp" alt="" loading="eager" width="100px" height="100px">
                        <h3>
                           Team of Experts
                        </h3>
                        <p>
                            From creative ghostwriters to innovative marketers, we have the most skilled experts on board. 
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="choose-card">
                        <img src="ghostwriting/assets/images/choose/2.webp" alt="" loading="eager" width="100px" height="100px">
                        <h3>
                            Dependable Customer Support
                        </h3>
                        <p>
                            Want an urgent revision or have an idea to share? Our team is available to assist you in every way. 
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="choose-card">
                        <img src="ghostwriting/assets/images/choose/3.webp" alt="" loading="eager" width="100px" height="100px">
                        <h3>
                            Affordable Packages
                        </h3>
                        <p>
                            Don’t let a lack of funds stop you from achieving your publishing dreams. Get published now, within your budget. 
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="choose-card">
                        <img src="ghostwriting/assets/images/choose/4.webp" alt="" loading="eager" width="100px" height="100px">
                        <h3>
                            100% Satisfaction Guaranteed 
                        </h3>
                        <p>
                           We offer unlimited revisions and take pride in our 100% satisfaction guarantee. We are perfectionists and will make it happen for you. 
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="choose-card">
                        <img src="ghostwriting/assets/images/choose/5.webp" alt="" loading="eager" width="100px" height="100px">
                        <h3>
                            Quick Turnaround Time
                        </h3>
                        <p>
                            We promise the most justified deadlines, ensuring that we deliver quality services to you in the best possible timeframe. 
                        </p>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="btn-wrap justify-content-center mb-0">
                        <a href="javascript:;" class="theme-btn popstatic">Get Started</a>
                        <a href="javascript:;" class="theme-btn white bordered" onclick="setButtonURL();">Live Chat</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-lg-7">
                    <div class="sec-heading">
                        <h2>
                            Win Hearts and Captivate Minds with Our Self-Publishing Services
                        </h2>
                        <p>
                            A bestseller needs a powerful vision, the correct verbiage, a professional look, and an effective marketing strategy. And we at <?php echo $brand;?> offer it all. From conceptualization to helping a book reach far and wide, we are your self-publishing dream team. Our reliable services with our team’s integrity and transparency, make us the most reliable book writing companies in the country. 
                        </p>
                        <p>
                            We don’t just claim; we make it happen! 
                        </p>
                    </div>
                    <div class="btn-wrap  mb-0">
                        <a href="javascript:;" class="theme-btn popstatic">Get Started</a>
                        <a href="javascript:;" class="theme-btn  bordered" onclick="setButtonURL();">Live Chat</a>
                    </div>
                </div>
                <div class="col-lg-5">
                    <img src="ghostwriting/assets/images/self-published.webp" alt="" loading="eager" width="100px" height="100px">
                </div>
            </div>
        </div>
    </section>
    <section class="bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="sec-heading center">
                        <h2>
                            Hear it from our clients! 
                        </h2>
                        <p>
                            It’s okay to be skeptical and do your due diligence before deciding—hear what our clients say about our services. 
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="testimonials">
                        <div>
                            <div class="testi-slide">
                                <img src="ghostwriting/assets/images/qoute.webp" alt="" loading="lazy" width="100px" height="100px"
                                    class="qoute">
                                <p>
                                    I had the most adorable illustrations that I wanted to use for a children’s book, but I did not have it in me to write a story. My daughter’s teacher recommended <?php echo $brand;?>. And they proved to be of so much help. My illustrations with their creative storytelling helped me create  a very fun read that my faughter absolutely loves. 
                                </p>
                                <div class="clients">
                                    <img src="ghostwriting/assets/images/clients/f1.webp" alt="">
                                    <span class="name">Dana Thompson</span>
                                </div>
                                <img src="ghostwriting/assets/images/trustpilot-logo.webp" alt="" loading="lazy" width="100px"
                                    height="100px">
                            </div>
                        </div>
                        <div>
                            <div class="testi-slide">
                                <img src="ghostwriting/assets/images/qoute.webp" alt="" loading="lazy" width="100px" height="100px"
                                    class="qoute">
                                <p>
                                    Being a full-time mom, I barely got the time to complete my healthcare manual that I was preparing for the clinic I work at. Thankfully, <?php echo $brand;?> had a healthcare expert who assisted me in completing the manual and they even assited me in printing the manual. Happy for choosing them. 
                                </p>
                                <div class="clients">
                                    <img src="ghostwriting/assets/images/clients/f2.webp" alt="">
                                    <span class="name">Briana Williams </span>
                                </div>
                                <img src="ghostwriting/assets/images/google.webp" alt="" loading="lazy" width="100px" height="100px">
                            </div>
                        </div>
                        <div>
                            <div class="testi-slide">
                                <img src="ghostwriting/assets/images/qoute.webp" alt="" loading="lazy" width="100px" height="100px"
                                    class="qoute">
                                <p>
                                    I wrote a pretty awesome fiction book but book cover designing was not my forte. I was sure that a bad book cover would turn my book into a failed project. After discussing this with the project manager at <?php echo $brand;?> I was at peace. And I was absolutely thrilled when the final cover was forwarded to me. Very happy with it. Can’t wait to publish it. 
                                </p>
                                <div class="clients">
                                    <img src="ghostwriting/assets/images/clients/m1.webp" alt="">
                                    <span class="name">James Adam</span> 
                                </div>
                                <img src="ghostwriting/assets/images/clutch.webp" alt="" loading="lazy" width="100px" height="100px">
                            </div>
                        </div>
                        <div>
                            <div class="testi-slide">
                                <img src="ghostwriting/assets/images/qoute.webp" alt="" loading="lazy" width="100px" height="100px"
                                    class="qoute">
                                <p>
                                    Highly recommend <?php echo $brand;?> for self-publisihing. Reliable services. Very good team and like their unlimited revision option. Would love to work with them again for my next books. 
                                </p>
                                <div class="clients">
                                    <img src="ghostwriting/assets/images/clients/f3.webp" alt="">
                                    <span class="name">Alison Deloris </span>
                                </div>
                                <img src="ghostwriting/assets/images/trustpilot-logo.webp" alt="" loading="lazy" width="100px"
                                    height="100px">
                            </div>
                        </div>
                        <div>
                            <div class="testi-slide">
                                <img src="ghostwriting/assets/images/qoute.webp" alt="" loading="lazy" width="100px" height="100px"
                                    class="qoute">
                                <p>
                                    I chose <?php echo $brand;?> for marketing of my book after they helped me publish it. While I was very satisfied with the publishing service, I could not leave without praising their marketing assistance. The best thing was the video book trailer they created. Recommenended! 
                                </p>
                                <div class="clients">
                                    <img src="ghostwriting/assets/images/clients/m2.webp" alt="">
                                    <span class="name">Larry Dave</span>
                                </div>
                                <img src="ghostwriting/assets/images/trustpilot-logo.webp" alt="" loading="lazy" width="100px"
                                    height="100px">
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-dark">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-lg-7">
                    <div class="sec-heading white">
                        <h2>
                            Need Help Writing a Book? Hire Book Writers at <?php echo $brand;?> Today!
                        </h2>
                        <p>
                            We at <?php echo $brand;?> excel at turning writers into successfully published authors. From ghostwriting to marketing, we know the secret to turning your book into a sensation. 
                        </p>
                    </div>
                    <ul class="check-list white grid-3">
                        <li>Ghostwriting</li>
                        <li>Novel writing</li>
                        <li>Scriptwriting</li>
                        <li>Book publishing</li>
                        <li>Cover design</li>
                        <li>Book editing</li>
                        <li>Book illustration</li>
                        <li>Children books</li>
                        <li>Recipe books</li>
                        <li>Biography</li>
                        <li>Book printing</li>
                        <li>Book marketing</li>
                        <li>Audiobooks</li>
                        <li>Book formatting</li>
                        <li>Book layout, & typesetting</li>
                    </ul>
                    <div class="logo-grid">
                        <img src="ghostwriting/assets/images/logos/1.webp" alt="" loading="lazy" width="100px" height="100px">
                        <img src="ghostwriting/assets/images/logos/2.webp" alt="" loading="lazy" width="100px" height="100px">
                        <img src="ghostwriting/assets/images/logos/3.webp" alt="" loading="lazy" width="100px" height="100px">
                        <img src="ghostwriting/assets/images/logos/4.webp" alt="" loading="lazy" width="100px" height="100px">
                        <img src="ghostwriting/assets/images/logos/5.webp" alt="" loading="lazy" width="100px" height="100px">
                        <img src="ghostwriting/assets/images/logos/6.webp" alt="" loading="lazy" width="100px" height="100px">
                        <img src="ghostwriting/assets/images/logos/7.webp" alt="" loading="lazy" width="100px" height="100px">
                        <img src="ghostwriting/assets/images/logos/8.webp" alt="" loading="lazy" width="100px" height="100px">
                    </div>
                </div>
                <div class="col-lg-5">
                    <form action="/leads/" method="POST" class="form">
                    <input type="hidden" name="route" value="<?= $_SERVER['REQUEST_URI'] ?>">
<input type="hidden" name="brief" value="">
<input type="hidden" name="brand" value="NATIVEBOOKAUTHORS">
<input type="hidden" name="token" value="<?= $token; ?>">
<input type="hidden" name="tag" value="top-form">
<input type="hidden" name="price" value="null">
<input type="hidden" name="news" value="1">
           <input type="hidden" name="subject" value="Banner Form (nativebookauthors.com)">
                        <h3>Sign up to AVAIL</h3>
                        <p>
                            Discuss Your Project With Our Experts
                        </p>
                        <input type="text" name="name" placeholder="Enter Your Name" required>
                        <input type="email" name="email" placeholder="Enter Your Email" required>
                        <input type="text" name="phone" placeholder="Phone Number" required>
                        <textarea name="" id="" name="brief" rows="4" required placeholder="Brief Description"></textarea>
                        <button type="submit">Submit</button>
                    </form>
                </div>
                <div class="col-lg-12">
                    <p class="normal-text white">
                        Want all your book writing and publishing needs addressed? The team at <?php echo $brand;?> is what you need to get your book out of your mind and onto the shelves! 
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="cta" style="--cta:url('../images/cta2.webp')no-repeat; --width:40%;">
                <div class="row g-4">
                    <div class="col-lg-7">
                        <div class="sec-heading white">
                            <h2>
                            Queries? Questions? Concerns?
                            </h2>
                            <p>
                            Let’s get in touch and get you sorted!
                            </p>
                            <h3>
                            Start now!
                            </h3>
                        </div>
                        <div class="btn-wrap  mb-0">
                        <a href="javascript:;" class="theme-btn popstatic">Get Started</a>
                        <a href="javascript:;" class="theme-btn white bordered" onclick="setButtonURL();">Live Chat</a>
                        <a href="tel:<?php echo $phone;?>" class="theme-btn white bordered"><i class="fa fa-phone"></i> <?php echo $phone;?></a>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="bg-dark">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="sec-heading center white">
                        <h2>
                        Ready? Let’s Get Started!
                        </h2>
                    </div>
                    <div class="btn-wrap justify-content-center">
                        <a href="tel:<?php echo $phone;?>" class="theme-btn"><i class="fa fa-phone"></i> <?php echo $phone;?></a>
                        <a href="mailto:<?php echo $email;?>" class="theme-btn white bordered"><?php echo $email;?></a>
                    </div>
                    <p class="normal-text white">
                        <i class="fa fa-location-dot"></i>
                        <?php echo $address;?>
                    </p>
                    <span class="hdng">
                    Disclaimer
                    </span>
                    <p class="normal-text white">
                    The services provided by <?php echo $brand;?> become clients' property once delivered. <?php echo $brand;?> will not hold any ownership rights once your work is successfully accepted by a publishinghouse.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <?php include("includes/footer.php"); ?>
    <?php include("includes/scripts.php"); ?>




</body>



</html>