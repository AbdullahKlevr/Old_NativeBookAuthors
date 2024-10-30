<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("includes/compatibility.php"); ?>
    <meta name="description"
        content="Attract readers and boost sales with our dedicated marketing support tailored for <?php echo $brand;?>. Let us navigate the promotional landscape while you focus on crafting captivating stories.">
    <title>Book Marketing and Promotion Services - <?php echo $brand;?></title>
    <?php include("includes/style.php"); ?>
</head>

<body>

    <div class="mainBanner">
        <?php include("includes/header.php"); ?>
        <div class="container">
            <div class="banner-content">
                <div class="row g-4 align-items-center justify-content-center">
                    <div class="col-lg-7">
                        <h1 class="banner-heading">
                           <span> Win Hearts</span> and Stir Hype with the Most Trusted Book Marketing Services
                        </h1>
                        <p class="banner-text">
                           We believe in your stories and are ready to share them with the world! 
                        </p>
                        <div class="btn-wrap">
                            <a href="javascript:;" class="theme-btn popstatic">Get Started</a>
                            <a href="javascript:;" class="theme-btn bordered" onclick="setButtonURL();">Live Chat</a>
                        </div>
                        <ul class="ban-list">
                            <li>Maximize Reach</li>
                            <li>Creative Marketers</li>
                            <li>Sales-driven Marketing Strategies </li>
                            <li>Guaranteed 24/7 customer support</li>
                            <li>Brand Presence </li>
                        </ul>

                    </div>
                    <div class="col-lg-5">
                        <form class="ban-form" method="POST" action="/leads/">>
                        
            <input type="hidden" name="route" value="<?= $_SERVER['REQUEST_URI'] ?>">
<input type="hidden" name="brief" value="">
<input type="hidden" name="brand" value="NATIVEBOOKAUTHORS">
<input type="hidden" name="token" value="<?= $token; ?>">
<input type="hidden" name="tag" value="top-form">
<input type="hidden" name="price" value="null">
<input type="hidden" name="news" value="1">
           <input type="hidden" name="subject" value="Banner Form (nativebookauthors.com)">
                            <div id="countdown">
                                <ul>
                                    <li>HOURS<span id="hours"></span></li>

                                    <li>MINUTES<span id="minutes"></span></li>

                                    <li>SECONDS<span id="seconds"></span></li>
                                </ul>
                            </div>
                            <span class="hdng">Get Started Today!</span>
                            <input type="text" name="name" placeholder="Full Name" required>
                            <input type="text" name="email" placeholder="Email" required>
                            <div class="newcountrycode contact-dd">
                                <span class="fg1"></span>
                                <?php include("includes/countryList.php"); ?>

                                <input type="text" name="countrycode" class="countrycode" id="countrycode" readonly=""
                                    value="+1">
                                <input type="text" id="phoneNum2" placeholder="" name="phone" required="" class="phone-field">
                                <input type="hidden" name="popuppackage" id="popuppackage"
                                    value="a597e50502f5ff68e3e25b9114205d4a">
                            </div>
                            <button type="submit">Get Started</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="counter-wrap goto">
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
                        <li>
                            <span class="count">60</span><span>+</span>
                            <p>Award-winning writers</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <section>
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-lg-6">
                    <div class="sec-heading">
                        <h2>
                           Let’s Turn Your Book into a Bestseller! 
                        </h2>
                        <p>
                            We value your stories like our own. Book writing is a form of art that requires talent and patience, but reaching your target audience can be a hectic task. Don’t worry—we've got you covered; our team of marketing experts will assist you in reaching your desired audience. 
                        </p>
                    </div>
                    <div class="btn-wrap">
                        <a href="javascript:;" class="theme-btn popstatic">Let’s Get Started</a>
                        <a href="javascript:;" class="theme-btn bordered " onclick="setButtonURL();">
                            Live Chat
                        </a>
                        <a href="javascript:;" class="theme-btn bordered ">
                            <?php echo $phone;?>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 text-md-end">
                    <img src="book-marketing/assets/images/s1.webp" alt="" loading="lazy" width="100px" height="100px">
                </div>
            </div>
        </div>
    </section>
    <section class="bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="sec-heading center ">
                        <h2>A Convenient Path to Reach Your Target Audience </h2>
                        <p>
                            Do you want to avoid the hassle of finding the right marketing strategy for your books? Our team of professionals specializes in turning books into market sensations! 
                        </p>
                    </div>
                </div>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-lg-4 col-md-6">
                    <div class="bordered-card">
                        <img src="book-marketing/assets/images/icons/1.webp" alt="" loading="lazy" width="100px" height="100px">
                        <h3>Adapting to recent trends: Innovations</h3>
                        <p>
                            With decades of experience connecting to the right individuals, we adhere to the growing need for technological innovations to boost your publishing potential. At <?php echo $brand;?>, we run intricate details in our work, and our team of professionals covers every marketing domain that your books need. 
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="bordered-card">
                        <img src="book-marketing/assets/images/icons/2.webp" alt="" loading="lazy" width="100px" height="100px">
                        <h3>Tailored approach: Comprehensive Strategies </h3>
                        <p>
                            We ensure our marketing style is centered on the client’s needs. With carefully curated content, we ensure our processes adhere to the needs of existing market trends. 
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="bordered-card">
                        <img src="book-marketing/assets/images/icons/3.webp" alt="" loading="lazy" width="100px" height="100px">
                        <h3>Building a Community: Maximizing Reach </h3>
                        <p>
                            We understand how important it is for a book to reach the right audience. Through a variety of techniques, from maintaining content quality to making it a priority to get your book published on platforms where the target audience is able to reach, we ensure that your publishing can gather maximum reach. 
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="bordered-card">
                        <img src="book-marketing/assets/images/icons/4.webp" alt="" loading="lazy" width="100px" height="100px">
                        <h3>Curated Content: Optimized Listing</h3>
                        <p>
                            Our team at <?php echo $brand;?> makes it their responsibility to incorporate keywords that bring attention to your books. With expert knowledge in SEO strategies, <?php echo $brand;?> practically guarantees you content that generates maximum potential leads. 
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="bordered-card">
                        <img src="book-marketing/assets/images/icons/5.webp" alt="" loading="lazy" width="100px" height="100px">
                        <h3>Personalized Branding: Social Media Presence </h3>
                        <p>
                            Throughout our marketing processes, our primary goal is to address the unique needs of authors. In addition to book marketing, we make it our duty to digitally grow the author’s presence on current social media platforms.
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
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="sec-heading center ">
                        <h2>A Sneak Peek into Our Wonders! </h2>
                        <p>
                            Stop scrolling, and prepare to be swept off your feet by our strong portfolio, which makes us one of the country’s best marketing companies! 
                        </p>
                    </div>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <a data-fancybox="gallery" href="book-marketing/assets/images/portfolio/full/1.webp" tabindex="0"
                        class="portfolio">
                        <img src="book-marketing/assets/images/portfolio/1.webp" alt="" loading="lazy" width="100px" height="100px">
                    </a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <a data-fancybox="gallery" href="book-marketing/assets/images/portfolio/full/2.webp" tabindex="0"
                        class="portfolio">
                        <img src="book-marketing/assets/images/portfolio/2.webp" alt="" loading="lazy" width="100px" height="100px">
                    </a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <a data-fancybox="gallery" href="book-marketing/assets/images/portfolio/full/3.webp" tabindex="0"
                        class="portfolio">
                        <img src="book-marketing/assets/images/portfolio/3.webp" alt="" loading="lazy" width="100px" height="100px">
                    </a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <a data-fancybox="gallery" href="book-marketing/assets/images/portfolio/full/4.webp" tabindex="0"
                        class="portfolio">
                        <img src="book-marketing/assets/images/portfolio/4.webp" alt="" loading="lazy" width="100px" height="100px">
                    </a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <a data-fancybox="gallery" href="book-marketing/assets/images/portfolio/full/5.webp" tabindex="0"
                        class="portfolio">
                        <img src="book-marketing/assets/images/portfolio/5.webp" alt="" loading="lazy" width="100px" height="100px">
                    </a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <a data-fancybox="gallery" href="book-marketing/assets/images/portfolio/full/6.webp" tabindex="0"
                        class="portfolio">
                        <img src="book-marketing/assets/images/portfolio/6.webp" alt="" loading="lazy" width="100px" height="100px">
                    </a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <a data-fancybox="gallery" href="book-marketing/assets/images/portfolio/full/7.webp" tabindex="0"
                        class="portfolio">
                        <img src="book-marketing/assets/images/portfolio/7.webp" alt="" loading="lazy" width="100px" height="100px">
                    </a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <a data-fancybox="gallery" href="book-marketing/assets/images/portfolio/full/8.webp" tabindex="0"
                        class="portfolio">
                        <img src="book-marketing/assets/images/portfolio/8.webp" alt="" loading="lazy" width="100px" height="100px">
                    </a>
                </div>

                <div class="col-lg-12">
                    <div class="btn-wrap justify-content-center">
                        <a href="javascript:;" class="theme-btn popstatic">Let’s Get Started</a>
                        <a href="javascript:;" class="theme-btn bordered "><i class="fa fa-phone"></i>
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

    <section class="cta-wrap">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="sec-heading white center">
                        <h2>
                            Ready to be Listed Among the Best Sellers in the USA?
                        </h2>
                        <p>
                            <?php echo $brand;?> is your partner in executing competitive marketing tactics to increase your sales and get your story the audience it deserves! 
                        </p>
                    </div>
                    <div class="btn-wrap justify-content-center">
                        <a href="javascript:;" class="theme-btn popstatic">Get Started</a>
                        <a href="javascript:;" class="theme-btn white bordered" onclick="setButtonURL();">Live Chat</a>
                        <a href="tel:<?php echo $phone;?>" class="theme-btn white bordered"><i class="fa fa-phone"></i>
                            <?php echo $phone;?></a>

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
                            Complete Book Marketing Solutions!
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-lg-12">
                    <ul class="overview-nav d2">
                        <li data-targetit="box-1" class=" active">
                            <a href="javascript:;">Social Media Presence </a>
                        </li>
                        <li data-targetit="box-2">
                            <a href="javascript:;">Amazon Listings </a>
                        </li>
                        <li data-targetit="box-3">
                            <a href="javascript:;">Video Trailers</a>
                        </li>
                        <li data-targetit="box-4">
                            <a href="javascript:;">Author Branding</a>
                        </li>
                        <li data-targetit="box-5">
                            <a href="javascript:;">Blogs and Articles</a>
                        </li>
                       
                    </ul>
                </div>
                <div class="col-lg-12">
                    <div class="box-1 showfirst  port-content" style="display:block">
                        <div class="row g-4 align-items-center">
                            <div class="col-md-6">
                                <div class="sec-heading ">
                                    <h2>
                                        Social Media Presence 
                                    </h2>
                                    <p>
                                        We at <?php echo $brand;?> don’t underestimate the importance of using social media branding strategies to elevate the potential of your books. 
                                    </p>
                                </div>
                                <div class="btn-wrap">
                                    <a href="javascript:;" class="theme-btn popstatic">Get Started</a>
                                    <a href="javascript:;" class="theme-btn  bordered" onclick="setButtonURL();">Live
                                        Chat</a>
                                    <a href="tel:<?php echo $phone;?>" class="theme-btn  bordered"><i
                                            class="fa fa-phone"></i> <?php echo $phone;?></a>

                                </div>
                            </div>
                            <div class="col-lg-4 offset-lg-2 col-md-6">
                                <img src="book-marketing/assets/images/genres/1.webp" alt="" loading="eager" width="100px"
                                    height="100px">
                            </div>
                        </div>
                    </div>
                    <div class="box-2 port-content">
                        <div class="row g-4 align-items-center">
                            <div class="col-md-6">
                                <div class="sec-heading ">
                                    <h2>
                                        Amazon Listings 
                                    </h2>
                                    <p>
                                        At <?php echo $brand;?>, our team of SEO specialists uses their skills to find keywords that appear at the top of the listings on Amazon and other relevant platforms. 
                                    </p>
                                </div>
                                <div class="btn-wrap">
                                    <a href="javascript:;" class="theme-btn popstatic">Get Started</a>
                                    <a href="javascript:;" class="theme-btn  bordered" onclick="setButtonURL();">Live
                                        Chat</a>
                                    <a href="tel:<?php echo $phone;?>" class="theme-btn  bordered"><i
                                            class="fa fa-phone"></i> <?php echo $phone;?></a>

                                </div>
                            </div>
                            <div class="col-lg-4 offset-lg-2 col-md-6">
                                <img src="book-marketing/assets/images/genres/2.webp" alt="" loading="eager" width="100px"
                                    height="100px">
                            </div>
                        </div>
                    </div>
                    <div class="box-3 port-content">
                        <div class="row g-4 align-items-center">
                            <div class="col-md-6">
                                <div class="sec-heading ">
                                    <h2>
                                        Video Trailers
                                    </h2>
                                    <p>
                                        We help build pre-release hype around your book by creating captivating video book trailers that make readers anticipate its release! 
                                    </p>
                                </div>
                                <div class="btn-wrap">
                                    <a href="javascript:;" class="theme-btn popstatic">Get Started</a>
                                    <a href="javascript:;" class="theme-btn  bordered" onclick="setButtonURL();">Live
                                        Chat</a>
                                    <a href="tel:<?php echo $phone;?>" class="theme-btn  bordered"><i
                                            class="fa fa-phone"></i> <?php echo $phone;?></a>

                                </div>
                            </div>
                            <div class="col-lg-4 offset-lg-2 col-md-6">
                                <img src="book-marketing/assets/images/genres/3.webp" alt="" loading="eager" width="100px"
                                    height="100px">
                            </div>
                        </div>
                    </div>
                    <div class="box-4 port-content">
                        <div class="row g-4 align-items-center">
                            <div class="col-md-6">
                                <div class="sec-heading ">
                                    <h2>
                                       Author Branding
                                    </h2>
                                    <p>
                                        Add that extra pinch of value for your book with a powerful author brand through press releases, podcasts, media interviews, and whatnot! 
                                    </p>
                                </div>
                                <div class="btn-wrap">
                                    <a href="javascript:;" class="theme-btn popstatic">Get Started</a>
                                    <a href="javascript:;" class="theme-btn  bordered" onclick="setButtonURL();">Live
                                        Chat</a>
                                    <a href="tel:<?php echo $phone;?>" class="theme-btn  bordered"><i
                                            class="fa fa-phone"></i> <?php echo $phone;?></a>

                                </div>
                            </div>
                            <div class="col-lg-4 offset-lg-2 col-md-6">
                                <img src="book-marketing/assets/images/genres/4.webp" alt="" loading="eager" width="100px"
                                    height="100px">
                            </div>
                        </div>
                    </div>
                    <div class="box-5 port-content">
                        <div class="row g-4 align-items-center">
                            <div class="col-md-6">
                                <div class="sec-heading ">
                                    <h2>
                                        Blogs and Articles
                                    </h2>
                                    <p>
                                        Give your audience a chance to get to know your vision and you. It will do wonders for your books. Let us help you engage your audience through impactful blogs and articles.  
                                    </p>
                                </div>
                                <div class="btn-wrap">
                                    <a href="javascript:;" class="theme-btn popstatic">Get Started</a>
                                    <a href="javascript:;" class="theme-btn  bordered" onclick="setButtonURL();">Live
                                        Chat</a>
                                    <a href="tel:<?php echo $phone;?>" class="theme-btn  bordered"><i
                                            class="fa fa-phone"></i> <?php echo $phone;?></a>

                                </div>
                            </div>
                            <div class="col-lg-4 offset-lg-2 col-md-6">
                                <img src="book-marketing/assets/images/genres/5.webp" alt="" loading="eager" width="100px"
                                    height="100px">
                            </div>
                        </div>
                    </div>
                    
                    
                    
                </div>
            </div>
        </div>
    </section>
    <section class="bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="sec-heading center ">
                        <h2>
                            Why <?php echo $brand;?>?
                        </h2>
                        <p>
                            Our proven track record of driving results makes us the best fit to cater to your book marketing needs.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row g-4 justify-content-center">

                <div class="col-lg-4 col-md-6">
                    <div class="choose-card">
                        <h3>
                            Diverse Portfolio
                        </h3>
                        <p>
                            Whether sci-fi or a self-help book, we have helped every book top the charts on Amazon and all other platforms!  
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="choose-card">
                        <h3>
                           Team of Professionals
                        </h3>
                        <p>
                            We have experienced marketers, experienced in their fields, to help your published material gain an audience. 
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="choose-card">
                        <h3>
                            Sales driven strategies
                        </h3>
                        <p>
                            We have a proven record of curating and implementing marketing strategies that pave the way for a book to become a must-read! 
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="choose-card">
                        <h3>
                           Tailored approach
                        </h3>
                        <p>
                            All our marketing strategies are tailored to meet the needs and requirements of the author. We mold our game according to the industry and audience! 
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="choose-card">
                        <h3>
                            Guaranteed Customer Satisfaction
                        </h3>
                        <p>
                            We ensure that our clients are satisfied with our service and offer no compromises on the quality of work. 
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="choose-card">
                        <h3>
                            Ethical Work Practices
                        </h3>
                        <p>
                            We take pride in our professional work ethics, ensuring timely deliveries and transparent communication. 
                        </p>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="btn-wrap justify-content-center mb-0">
                        <a href="javascript:;" class="theme-btn popstatic">Get Started</a>
                        <a href="javascript:;" class="theme-btn  bordered" onclick="setButtonURL();">Live Chat</a>
                        <a href="tel:<?php echo $phone;?>" class="theme-btn  bordered"><i class="fa fa-phone"></i>
                            <?php echo $phone;?></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-dark">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-lg-12">
                    <div class="sec-heading center white">
                        <h2>
                            Get Connected with a Community that Resonates with Your Work 
                        </h2>
                        <p>
                            A bestselling book needs a robust marketing campaign with words that build engagement with the right audience. We believe that Native writers have ample resources to turn your publishing into the best-seller list in the USA. We pride ourselves on our commitment, reliability, and excellent customer service. 
                        </p>
                        <p>
                            We turn words into action! 
                        </p>
                    </div>
                    <div class="btn-wrap justify-content-center mb-0">
                        <a href="javascript:;" class="theme-btn popstatic">Get Started</a>
                        <a href="javascript:;" class="theme-btn white bordered" onclick="setButtonURL();">Live Chat</a>
                        <a href="tel:<?php echo $phone;?>" class="theme-btn white bordered"><i class="fa fa-phone"></i>
                            <?php echo $phone;?></a>
                    </div>
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
                            It's okay to be skeptical and do your due diligence before deciding—hear what our clients say about our services. 
                        </p>
                    </div>
                </div>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-lg-4">
                    <div class="testi-slide">
                        <div class="clients">
                            <img src="book-marketing/assets/images/clients/m3.webp" alt="">
                            <div class="det">
                                <span class="name">Ben Cooper </span>
                             
                            </div>
                        </div>
                        <p>
                            I highly recommend <?php echo $brand;?> for book marketing. Efficient team and like their work ethics. Would love to work with them again.
                        </p>
                        <span class="stars">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </span>
                        <img src="book-marketing/assets/images/satisfied.webp" alt="" loading="lazy" width="100px" height="100px">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="testi-slide">
                        <div class="clients">
                            <img src="book-marketing/assets/images/clients/m1.webp" alt="">
                            <div class="det">
                                <span class="name">Isaac Dawson</span>
                                
                            </div>
                        </div>
                        <p>
                           I published my book two years ago but could sell only ten books, which broke my heart. As I was exploring options, I came across <?php echo $brand;?>, and their marketers on board are so creative. They discussed the entire marketing strategy with me and offered complete transparency. The sales have now started coming in, and I am hopeful that we can do better with their scaling. Great service.
                        </p>
                        <span class="stars">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </span>
                        <img src="book-marketing/assets/images/satisfied.webp" alt="" loading="lazy" width="100px" height="100px">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="testi-slide">
                        <div class="clients">
                            <img src="book-marketing/assets/images/clients/f1.webp" alt="">
                            <div class="det">
                                <span class="name">Ezra Fitz</span>
                                
                            </div>
                        </div>
                        <p>
                            I did not even know there was a thing called video book trailers. The first look at my book’s trailer was so impressive. I was in tears, literally. My book got so many good reviews even before it was published. It was a very smart idea. 
                        </p>
                        <span class="stars">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </span>
                        <img src="book-marketing/assets/images/satisfied.webp" alt="" loading="lazy" width="100px" height="100px">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="testi-slide">
                        <div class="clients">
                            <img src="book-marketing/assets/images/clients/m2.webp" alt="">
                            <div class="det">
                                <span class="name">Adam St. Clair</span>
                                
                            </div>
                        </div>
                        <p>
                            Social media marketing is so vast, and there’s so much we can do with it. I'd like to give all my thanks to the social media marketers at <?php echo $brand;?> for helping me extract the most out of my social media accounts. Their posting led to high engagement and shareable content. I've got to build a vast ground for my book’s release.  
                        </p>
                        <span class="stars">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </span>
                        <img src="book-marketing/assets/images/satisfied.webp" alt="" loading="lazy" width="100px" height="100px">
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="testi-slide">
                        <div class="clients">
                            <img src="book-marketing/assets/images/clients/m4.webp" alt="">
                            <div class="det">
                                <span class="name">Larry Dave</span>
                                
                            </div>
                        </div>
                        <p>
                            I chose <?php echo $brand;?> to market my book after they helped me publish it. While I was very satisfied with the publishing service, I could not leave without praising their marketing assistance. The best thing was the video book trailer they created. I recommend it! 
                        </p>
                        <span class="stars">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </span>
                        <img src="book-marketing/assets/images/satisfied.webp" alt="" loading="lazy" width="100px" height="100px">
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
                            Need Help Marketing Your Book to The World? Hire Marketing Professionals at <span><?php echo $brand;?></span> Today! 
                        </h2>
                        <p>
                            We at <?php echo $brand;?> excel in the services we claim to offer. From building the right channel to gathering an audience on various social media platforms to excellent customer service, we've got you covered. 
                        </p>
                        <p>
                            What we offer?
                        </p>
                    </div>
                    <ul class="check-list white grid-3">
                        <li>Book promotion tactics</li>
                        <li>Content marketing</li>
                        <li>Social media presence</li>
                        <li>Advertising campaigns</li>
                        <li>Audience engagement</li>
                        <li>Personal branding</li>
                        <li>Public relations and media press releases </li>
                        <li>E-book marketing</li>
                        <li>Reserve book royalties</li>
                        <li>SEO optimization</li>
                        <li>Book Marketing</li>
                        <li>Best-selling books</li>
                    </ul>
                   
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
                        <h3>Get Started Today!</h3>

                        <input type="text" name="name" placeholder="Enter Your Name" required>
                        <input type="email" name="email" placeholder="Enter Your Email" required>
                        <div class="newcountrycode contact-dd">
                            <span class="fg1"></span>
                            <?php include("includes/countryList.php"); ?>

                            <input type="text" name="countrycode" class="countrycode" id="countrycode" readonly=""
                                value="+1">
                            <input type="text" id="phoneNum2" name="phone" placeholder="" required="" class="phone-field">
                            <input type="hidden" name="popuppackage" id="popuppackage"
                                value="a597e50502f5ff68e3e25b9114205d4a">
                        </div>
                        <textarea name="" id="" rows="4" name="brief" required placeholder="Brief Description"></textarea>
                        <button type="submit">Submit</button>
                    </form>
                </div>
                <div class="col-lg-12">
                    <div class="logo-grid">
                        <img src="book-marketing/assets/images/logos/1.webp" alt="" loading="lazy" width="100px" height="100px">
                        <img src="book-marketing/assets/images/logos/2.webp" alt="" loading="lazy" width="100px" height="100px">
                        <img src="book-marketing/assets/images/logos/3.webp" alt="" loading="lazy" width="100px" height="100px">
                        <img src="book-marketing/assets/images/logos/4.webp" alt="" loading="lazy" width="100px" height="100px">
                        <img src="book-marketing/assets/images/logos/5.webp" alt="" loading="lazy" width="100px" height="100px">
                        <img src="book-marketing/assets/images/logos/6.webp" alt="" loading="lazy" width="100px" height="100px">
                        <img src="book-marketing/assets/images/logos/7.webp" alt="" loading="lazy" width="100px" height="100px">
                        <img src="book-marketing/assets/images/logos/8.webp" alt="" loading="lazy" width="100px" height="100px">
                    </div>
                </div>
                <div class="col-lg-12">
                    <p class="normal-text white">
                        Are you enthusiastic about boosting your story's marketing potential? You need a team of professionals who understand the value of your time and work at <?php echo $brand;?>.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="cta">
                <div class="row ">
                    <div class="col-lg-12">
                        <div class="sec-heading center white">
                            <h2>
                                We are happy to assist you with your queries.
                            </h2>
                            <p>
                                Let’s get in touch and get you sorted!
                            </p>
                            <h3>
                                Start now!
                            </h3>
                        </div>
                        <div class="btn-wrap justify-content-center mb-0">
                            <a href="javascript:;" class="theme-btn popstatic">Get Started</a>
                            <a href="javascript:;" class="theme-btn white bordered" onclick="setButtonURL();">Live
                                Chat</a>
                            <a href="tel:<?php echo $phone;?>" class="theme-btn white bordered"><i
                                    class="fa fa-phone"></i> <?php echo $phone;?></a>
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
                        <a href="tel:<?php echo $phone;?>" class="theme-btn"><i class="fa fa-phone"></i>
                            <?php echo $phone;?></a>
                        <a href="mailto:<?php echo $email;?>" class="theme-btn white bordered"><?php echo $email;?></a>
                    </div>
                    <p class="normal-text white">
                        <i class="fa fa-location-dot"></i>
                         <?php echo $address;?>
                    </p>
                    <span class="f-hdng ">
                        Plagiarism Report
                    </span>
                    <p class="normal-text white">
                        The services provided by <?php echo $brand;?> become clients' property once delivered. <?php echo $brand;?> will not
                        hold any ownership rights once your work is successfully accepted by a publishinghouse.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <?php include("includes/footer.php"); ?>
    <?php include("includes/scripts.php"); ?>




</body>



</html>