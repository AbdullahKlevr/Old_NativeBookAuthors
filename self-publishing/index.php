<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("includes/compatibility.php"); ?>
    <meta name="description"
        content="Achieve your publishing dreams effortlessly with <?php echo $brand;?> - your ultimate destination for self-publishing books and ebooks.">
    <title>Online Self Publishing Book & Ebook Company - <?php echo $brand;?></title>
    <?php include("includes/style.php"); ?>
</head>

<body>

    <div class="mainBanner">
        <?php include("includes/header.php"); ?>


        <div class="container">
            <div class="banner-content">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <span class="sub-heading">Self-Publishing Services</span>
                        <h1 class="banner-heading">
                            Become a Published Author Today!
                        </h1>
                        <p class="banner-text">
                            Whether you're an aspiring author seeking to share your stories with the world or an
                            established writer looking to take control of your publishing journey, we're here to guide
                            you. With our comprehensive suite of publishing and self-publishing services, we empower
                            authors to bring their visions to life.
                        </p>

                        <div class="btn-wrap">
                            <a href="javascript:;" class="theme-btn popstatic dark">Let’s Get Started</a>
                            <a href="javascript:;" class="theme-btn bordered white"><i class="fa fa-phone"></i>
                                <?php echo $phone;?></a>
                        </div>

                    </div>
                    <div class="col-xl-4 col-lg-5 offset-xl-2">
                        <form class="header-form form" action="/leads/" method="POST">
                        <input type="hidden" name="route" value="<?= $_SERVER['REQUEST_URI'] ?>">
<input type="hidden" name="brief" value="">
<input type="hidden" name="brand" value="NATIVEBOOKAUTHORS">
<input type="hidden" name="token" value="<?= $token; ?>">
<input type="hidden" name="tag" value="top-form">
<input type="hidden" name="price" value="null">
<input type="hidden" name="news" value="1">
           <input type="hidden" name="subject" value="Banner Form (nativebookauthors.com)">
                            <span class="hdng">
                                AVAIL OUR 50% DISCOUNT
                            </span>
                            <div id="countdown">
                                <ul>
                                    <li>HOURS<span id="hours"></span></li>

                                    <li>MINUTES<span id="minutes"></span></li>

                                    <li>SECONDS<span id="seconds"></span></li>
                                </ul>
                            </div>
                            <div class="field">
                                <input type="text" id="name" name="name" placeholder="Enter Your Name" required>
                            </div>
                            <div class="field">
                                <input type="email" id="email" name="email" placeholder="Enter Your Email" required>
                            </div>
                            <div class="field">
                                <input type="text" id="phone" name="phone" placeholder="Phone Number" required>
                            </div>

                            <div class="field">
                                <textarea name="" id="" rows="4" name="brief" required placeholder="Brief Description"></textarea>
                            </div>
                            <button type="submit" class="submit">Submit</button>

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
                            Expert Self-Publishing Services to Assist Aspiring Authors
                        </h2>
                        <p>
                            Are you ready to take control of your publishing journey and share your story with the
                            world? Look no further than <?php echo $brand;?> for top-notch self-publishing. Whether
                            you're considering Kindle self-publishing, exploring the best self-publishing companies, or
                            seeking distribution on platforms like Apple Books, IngramSpark, and Barnes & Noble, we've
                            got you covered. With our guidance and expertise, you can transform your manuscript into a
                            professionally published book that reaches readers everywhere.
                        </p>
                    </div>
                </div>
                <div class="col-lg-6 text-md-end">
                    <img src="self-publishing/assets/images/s1.webp" alt="" loading="lazy" width="100px" height="100px">
                </div>
            </div>
        </div>
    </section>
    <section class="bg-dark">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="sec-heading center white">
                        <h2>Our Publishing Services</h2>
                        <p>
                            We offer a range of comprehensive services to meet your self-publishing needs and goals.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="bordered-card">
                        <h3>Self-Publishing <br> Services </h3>
                        <p>
                            Our self-publishing services provide authors with the tools and resources needed to bring
                            their stories to life independently. Whether you're a first-time author or an experienced
                            writer, this service caters to authors at all stages of their publishing journey. From
                            formatting to distribution, we’ve got you covered.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="bordered-card">
                        <h3>Amazon Kindle <br> Self-Publishing </h3>
                        <p>
                            Amazon Kindle self-publishing offers authors unparalleled access to one of the largest ebook
                            markets in the world. We help you reach millions of readers worldwide with Amazon Kindle
                            self-publishing. Our expert guidance ensures that your book is optimized for digital
                            distribution, maximizing your visibility and potential sales.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="bordered-card">
                        <h3>Apple Books <br>Self-Publishing </h3>
                        <p>
                            Apple Books self-publishing offers authors a unique opportunity to showcase their work to a
                            global audience of Apple users. Publish your book on Apple Books and reach millions of
                            readers around the world. Our team will guide you through the process, ensuring that your
                            book meets Apple's rigorous standards for quality and compatibility.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="bordered-card">
                        <h3>Barnes and Noble <br> Self-Publishing </h3>
                        <p>
                            Barnes and Noble self-publishing provides authors with a valuable opportunity to connect
                            with readers through one of the largest retail chains in the United States. Whether you're
                            publishing in print or digital format, our Barnes and Noble self-publishing services cover
                            all the essentials, from formatting to metadata optimization.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="bordered-card">
                        <h3>Editing, Formatting,<br> and Cover Design </h3>
                        <p>
                            Our editing services encompass everything from proofreading to developmental editing,
                            providing comprehensive feedback and suggestions for improvement. Meanwhile, our formatting
                            and cover design experts will ensure that your book looks polished and professional, both
                            inside and out. Let us help you make a lasting impression on readers!
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="bordered-card">
                        <h3>Marketing and<br> Promotion </h3>
                        <p>
                            Stand out in the crowded marketplace with our book marketing services. We will develop a
                            customized strategy to promote your book to your target audience, maximizing its visibility
                            and sales potential. Whether you're launching a new book or looking to boost sales of an
                            existing title, let us help you build a loyal fan base for your work.
                        </p>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="btn-wrap justify-content-center">
                        <a href="javascript:;" class="theme-btn popstatic">Let’s Get Started</a>
                        <a href="javascript:;" class="theme-btn bordered white"><i class="fa fa-phone"></i>
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
                            Are You Experiencing Writer's Block?
                        </h2>
                        <p>
                            Various factors can hinder progress in book writing, slowing down your journey towards your
                            goal.
                        </p>
                    </div>
                    <ul class="factors">
                        <li>Lack of Inspiration </li>
                        <li>Fear of Failure</li>
                        <li>Overwhelm</li>
                        <li>Distractions</li>
                        <li>Self-Doubt</li>
                        <li>Burnout</li>
                        <li>Lack of Structure</li>
                        <li>Procrastination</li>
                        <li>External Pressure</li>

                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-lg-6">
                    <div class="sec-heading">

                        <h2>
                            Perks of Self-Publishing with Us
                        </h2>
                        <p>
                            Choosing Native Book Authors’ self-publishing service opens doors to a host of exclusive
                            advantages designed to improve your reach and publishing experience. From expert guidance
                            and transparent royalties to online distribution and professional marketing support, our
                            custom approach ensures that your book receives the attention it deserves. Join our
                            community of published authors and gain access to a range of tools and resources you need to
                            succeed in the literary world.
                        </p>

                        <h3>
                            Let Us Help Boost Your Writing Career
                        </h3>
                        <ul class="checklist">
                            <li>Thorough Proofreading of Manuscripts </li>
                            <li>Original Cover Design and Artwork </li>
                            <li>Development of Publication Proposals </li>
                            <li>Creation And Submission of Query Letters </li>
                            <li>In-Depth Editorial Assessments</li>
                        </ul>
                    </div>
                    <div class="btn-wrap">
                        <a href="javascript:;" class="theme-btn popstatic">Let’s Get Started</a>
                        <a href="javascript:;" class="theme-btn bordered "><i class="fa fa-phone"></i>
                            <?php echo $phone;?></a>
                    </div>
                </div>
                <div class="col-lg-5 text-md-end offset-lg-1">
                    <img src="self-publishing/assets/images/s2.webp" alt="" loading="lazy" width="100px" height="100px">
                </div>
            </div>
        </div>
    </section>
    <section class="bg-dark">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="sec-heading center white">
                        <h2>The Work We’ve Done </h2>
                        <p>
                            Get a glimpse of our portfolio, which undoubtedly sets us apart from the rest and makes us
                            your best choice for self-publishing services.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="portfolio-slider ">
                        <img src="self-publishing/assets/images/portfolio/1.webp" alt="" loading="lazy" width="100px" height="100px">
                        <img src="self-publishing/assets/images/portfolio/2.webp" alt="" loading="lazy" width="100px" height="100px">
                        <img src="self-publishing/assets/images/portfolio/3.webp" alt="" loading="lazy" width="100px" height="100px">
                        <img src="self-publishing/assets/images/portfolio/4.webp" alt="" loading="lazy" width="100px" height="100px">
                        <img src="self-publishing/assets/images/portfolio/5.webp" alt="" loading="lazy" width="100px" height="100px">
                        <img src="self-publishing/assets/images/portfolio/6.webp" alt="" loading="lazy" width="100px" height="100px">
                        <img src="self-publishing/assets/images/portfolio/7.webp" alt="" loading="lazy" width="100px" height="100px">
                        <img src="self-publishing/assets/images/portfolio/8.webp" alt="" loading="lazy" width="100px" height="100px">
                    </div>

                </div>
                <div class="col-lg-12">
                    <div class="btn-wrap justify-content-center">
                        <a href="javascript:;" class="theme-btn popstatic">Let’s Get Started</a>
                        <a href="javascript:;" class="theme-btn bordered white"><i class="fa fa-phone"></i>
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

                        <h2>Our Self-Publishing Packages</h2>

                    </div>
                </div>
                <div class="col-lg-12">
                    <ul class="pkg-list">
                        <li>
                            <div class="pckg">
                                <div class="upper">
                                    <h3 class="title">Novice </h3>
                                    <p>Perfect for aspiring authors taking their first steps into publishing.</p>
                                </div>
                                <div class="bottom">
                                    <div class="btn-wrap">
                                        <a href="javascript:;" class="theme-btn w-100 text-center popdynamic">Request A
                                            Quote </a>
                                    </div>
                                    <ul>
    <li>Layout Design to Standards</li>
    <li> Amazon Account Setup</li>
    <li> Kindle Paperback Publishing</li>
    <li> Print on Demand Setup</li>
    <li> Platform Optimization</li>
    <li> ISBN Barcode Assistance</li>
    <li> Author Book Profile Creation</li>
    <li> Expert Team Support</li>
    <li> 100% Ownership Rights</li>
    <li> Money Back Guarantee</li>
</ul>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="pckg">
                                <div class="upper">
                                    <h3 class="title">Experienced </h3>
                                    <p>Ideal for authors with some publishing experience under their belt.</p>
                                </div>
                                <div class="bottom">
                                    <div class="btn-wrap">
                                        <a href="javascript:;" class="theme-btn w-100 text-center popdynamic">Request A
                                            Quote </a>
                                    </div>
                                    <ul >
<li>2D Cover design</li>
<li>Publishing on 3 Platforms</li>
<li>Amazon, Barnes Noble, Kobo</li>
<li>ISBN Barcode Assistance</li>
<li>Author Book Profile Creation</li>
<li>Dedicated Online Dashboard</li>
<li>eBook, Paperback Hardcover</li>
<li>Press Release</li>
<li>Print on Demand</li>
<li>Dedicated Project Manager Support</li>
<li>100% Ownership Rights</li>
</ul>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="pckg">
                                <div class="upper">
                                    <h3 class="title">Seasoned</h3>
                                    <p>Designed for seasoned authors seeking to expand their reach.</p>
                                </div>
                                <div class="bottom">
                                    <div class="btn-wrap">
                                        <a href="javascript:;" class="theme-btn w-100 text-center popdynamic">Request A
                                            Quote </a>
                                    </div>
                                    <ul>
<li>2D Cover design</li>
<li>Publishing on 5 Platforms</li>
<li>Amazon, Kindle, Barnes Noble, Google Books, Apple</li>
<li>Books</li>
<li>ISBN Barcode Assistance</li>
<li>Editorial Review</li>
<li>eBook, Paperback Hardcover</li>
<li>Printing on Demand</li>
<li>Worldwide Distribution</li>
<li>Author Book Profile Creation</li>
<li>Dedicated Online Dashboard</li>
<li>Dedicated Project Manager Support</li>
<li>100% Ownership Rights</li>
<li>Social Media Marketing (1 Month)</li>
</ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="sec-heading center">
                        <h2>Our Six-Step Book Writing Process</h2>
                        <p>
                            Here's an overview of our six-step approach to help you bring your literary vision to life.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row g-0">
                <div class="col-lg-4">
                    <div class="number-card bb-1">
                        <span>01</span>
                        <h3>Initial Consultation</h3>
                        <p>
                            We begin by scheduling an initial consultation to discuss your book idea, goals, and vision.
                            Our team takes the time to understand your unique voice and style, ensuring that your book
                            stays true to your vision throughout the writing process.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="number-card bb-1 b-l-r">
                        <span>02</span>
                        <h3>Planning and Outlining</h3>
                        <p>
                            Once we have a clear understanding of your objectives, we work closely with you to develop a
                            detailed outline for your book. This serves as a roadmap for the writing process, ensuring
                            that we capture all essential elements of your story.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="number-card bb-1">
                        <span>03</span>
                        <h3>Writing and Collaboration</h3>
                        <p>
                            With the outline in hand, our experienced writers get to work crafting your manuscript. We
                            maintain open lines of communication throughout process, providing regular updates and
                            seeking your feedback to ensure that the story is according to your vision.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="number-card ">
                        <span>04</span>
                        <h3>Editing and Revision</h3>
                        <p>
                            After completing the first draft, our team conducts a thorough round of editing and
                            revision. We focus on refining the narrative, enhancing character development, and polishing
                            prose to ensure that your book is of the highest quality.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="number-card b-l-r">
                        <span>05</span>
                        <h3>Publication and Distribution </h3>
                        <p>
                            Once the manuscript is finalized, we will assist you in navigating the publication and
                            distribution process. We can help you publish on platforms like Amazon Kindle, Apple Books,
                            and Barnes & Noble, and many others to get you recognized.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="number-card ">
                        <span>06</span>
                        <h3>Marketing and Promotion</h3>
                        <p>
                            Our support doesn't end with publication—we help you promote your book and reach your target
                            audience. From developing marketing strategies to organizing online book launch events, we
                            provide support to maximize your book's visibility and sales potential.
                        </p>
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
                        <h2>What Our Clients Like About Us</h2>
                        <p>
                            We don’t need to say much. Hear it directly from our clients.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="testi-card">
                        <div class="upper">
                            <div class="client">
                                <img src="self-publishing/assets/images/clients/f1.webp" alt="" loading="lazy" width="100px"
                                    height="100px">
                                <div class="det">
                                    <span class="name">Sarah M.</span>
                                    <!-- <span class="des">CEO/Founder</span> -->
                                </div>
                            </div>
                            <p>
                                Working with <?php echo $brand;?> was a game-changer for me. The team guided me through
                                every step of the publishing process with professionalism and expertise. Thanks to their
                                support, I was able to see my book come to life and reach readers around the world.
                            </p>
                        </div>
                        <img src="self-publishing/assets/images/trustpilot.webp" alt="" loading="lazy" width="100px" height="100px">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="testi-card">
                        <div class="upper">
                            <div class="client">
                                <img src="self-publishing/assets/images/clients/m1.webp" alt="" loading="lazy" width="100px"
                                    height="100px">
                                <div class="det">
                                    <span class="name">Michael D.</span>
                                    <!-- <span class="des">CEO/Founder</span> -->
                                </div>
                            </div>
                            <p>
                                I can't recommend <?php echo $brand;?> highly enough for publishing. From editing to
                                cover design, they exceeded my expectations at every turn. I was quite nervous since I
                                was a novice writer, but they really helped me through and through. Fantastic service!
                            </p>
                        </div>
                        <img src="self-publishing/assets/images/trustpilot.webp" alt="" loading="lazy" width="100px" height="100px">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="testi-card">
                        <div class="upper">
                            <div class="client">
                                <img src="self-publishing/assets/images/clients/f2.webp" alt="" loading="lazy" width="100px"
                                    height="100px">
                                <div class="det">
                                    <span class="name">Emily P.</span>
                                    <!-- <span class="des">CEO/Founder</span> -->
                                </div>
                            </div>
                            <p>
                                As a first-time author, I was nervous about the publishing process, but
                                <?php echo $brand;?> made it seamless. Their team was patient, knowledgeable, and
                                incredibly supportive. I'm thrilled with the final result and grateful for their
                                guidance.
                            </p>
                        </div>
                        <img src="self-publishing/assets/images/trustpilot.webp" alt="" loading="lazy" width="100px" height="100px">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="testi-card">
                        <div class="upper">
                            <div class="client">
                                <img src="self-publishing/assets/images/clients/m2.webp" alt="" loading="lazy" width="100px"
                                    height="100px">
                                <div class="det">
                                    <span class="name">John W.</span>
                                    <!-- <span class="des">CEO/Founder</span> -->
                                </div>
                            </div>
                            <p>
                                Choosing <?php echo $brand;?> for my self-publishing needs was one of the best decisions
                                I've made. Their expertise in their craft is unmatched. Thanks to them, my book reached
                                bestseller status on multiple platforms. I couldn't be happier with the outcome.
                            </p>
                        </div>
                        <img src="self-publishing/assets/images/trustpilot.webp" alt="" loading="lazy" width="100px" height="100px">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="testi-card">
                        <div class="upper">
                            <div class="client">
                                <img src="self-publishing/assets/images/clients/f3.webp" alt="" loading="lazy" width="100px"
                                    height="100px">
                                <div class="det">
                                    <span class="name">Jessica H.</span>
                                    <!-- <span class="des">CEO/Founder</span> -->
                                </div>
                            </div>
                            <p>
                                The team at <?php echo $brand;?> truly cares about their authors' success. They went
                                above and beyond to ensure that my book was of the highest quality and that I was
                                completely satisfied with the end result. I'm grateful for their professionalism and
                                support.
                            </p>
                        </div>
                        <img src="self-publishing/assets/images/trustpilot.webp" alt="" loading="lazy" width="100px" height="100px">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="testi-card">
                        <div class="upper">
                            <div class="client">
                                <img src="self-publishing/assets/images/clients/m3.webp" alt="" loading="lazy" width="100px"
                                    height="100px">
                                <div class="det">
                                    <span class="name">David S.</span>
                                    <!-- <span class="des">CEO/Founder</span> -->
                                </div>
                            </div>
                            <p>
                                Publishing with <?php echo $brand;?> was a collaborative and rewarding experience from
                                start to finish. Their team listened to my ideas and brought them to life in ways I
                                never imagined. I'm proud to be a published author with their help.
                            </p>
                        </div>
                        <img src="self-publishing/assets/images/trustpilot.webp" alt="" loading="lazy" width="100px" height="100px">
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
                        <h2>Frequently Asked Questions</h2>
                        <p>
                            Find the answers to some of the most common questions that might pop into your head.
                        </p>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="accordion-list ">
                        <li>
                            <span>
                                <h3>What services do you offer to authors looking to self-publish?</h3>
                            </span>
                            <div class="answer">
                                <p>
                                    We offer a comprehensive suite of services, including professional editing, cover
                                    design, formatting, ISBN registration, and marketing strategies.
                                </p>
                            </div>
                        </li>

                        <li>
                            <span>
                                <h3>How does the publishing process work with your service?</h3>
                            </span>
                            <div class="answer">
                                <p>
                                    Our publishing process is author-centric, ensuring you maintain creative control.
                                    Once you submit your manuscript, we'll work with you on editing, design, and
                                    distribution, keeping you informed at every stage until your book is ready for
                                    readers.
                                </p>
                            </div>
                        </li>

                        <li>
                            <span>
                                <h3>Can you help with marketing my book?</h3>
                            </span>
                            <div class="answer">
                                <p>
                                    Absolutely! We provide tailored marketing plans that include social media promotion,
                                    press releases, and book launch strategies to help your book gain maximum exposure.
                                </p>
                            </div>
                        </li>
                        <li>
                            <span>
                                <h3>How long does it take to publish a book with your service?</h3>
                            </span>
                            <div class="answer">
                                <p>
                                    The timeline can vary depending on the complexity of the project. Schedule a
                                    consultation with us to learn more.
                                </p>
                            </div>
                        </li>
                        <li>
                            <span>
                                <h3>Do I retain the rights to my book?</h3>
                            </span>
                            <div class="answer">
                                <p>
                                    Yes, you retain all rights to your book. We believe in empowering authors, not
                                    restricting them.
                                </p>
                            </div>
                        </li>
                        <li>
                            <span>
                                <h3>What are the costs involved in self-publishing?</h3>
                            </span>
                            <div class="answer">
                                <p>
                                    Costs can vary based on the services you choose. We offer transparent pricing and
                                    can provide a detailed quote based on your specific needs.
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-dark">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-lg-6">
                    <div class="sec-heading white">
                        <h3>The Ultimate One-Stop Shop for Self-publishing </h3>
                        <p>
                            Are you tired of navigating the complex and daunting world of publishing on your own? Do you
                            feel overwhelmed by the multitude of tasks involved, from manuscript editing to marketing
                            strategies? It's time to put an end to the stress and uncertainty. Let <?php echo $brand;?>
                            be your trusted partner on your publishing journey. With our comprehensive range of services
                            and expert guidance, we'll alleviate your pain points and help you achieve your publishing
                            goals with confidence. Take the first step towards a smoother and more rewarding publishing
                            experience by contacting us today.
                        </p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <form action="/leads/" method="POST" class="form">
                    <input type="hidden" name="route" value="<?= $_SERVER['REQUEST_URI'] ?>">
<input type="hidden" name="brief" value="">
<input type="hidden" name="brand" value="NATIVEBOOKAUTHORS">
<input type="hidden" name="token" value="<?= $token; ?>">
<input type="hidden" name="tag" value="top-form">
<input type="hidden" name="price" value="null">
<input type="hidden" name="news" value="1">
           <input type="hidden" name="subject" value="Banner Form (nativebookauthors.com)">
                        <div class="row g-4">
                            <div class="col-lg-6">
                                <input type="text" name="name" placeholder="Enter Your Name" required>
                            </div>
                            <div class="col-lg-6">
                                <input type="email" name="email" placeholder="Enter Your Email" required>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" name="phone" placeholder="Phone Number" required>
                            </div>
                            <div class="col-lg-6">
                                <select required aria-required="true">
                                    <option value="I'm interested in">I'm interested in</option>
                                    <option value="Ghostwriting">Ghostwriting</option>
                                    <option value="Editing">Editing</option>
                                    <option value="Publishing">Publishing</option>
                                    <option value="Proof Writing">Proof Writing</option>
                                    <option value="Audio Book">Audio Book</option>
                                    <option value="Book Cover Design">Book Cover Design</option>
                                    <option value="Book Promotion">Book Promotion</option>
                                    <option value="Resume Writing">Resume Writing</option>
                                    <option value="Speech Writing">Speech Writing</option>
                                    <option value="Press Released">Press Released</option>
                                    <option value="Social Media Content">Social Media Content</option>
                                    <option value="SEO Writing ">SEO Writing </option>
                                    <option value="Article/Blog Writing">Article/Blog Writing</option>
                                    <option value="Web Copywriting">Web Copywriting</option>
                                    <option value="Brochure Writing">Brochure Writing</option>
                                    <option value="Business Writing">Business Writing</option>
                                </select>
                            </div>
                            <div class="col-lg-12">
                                <textarea name="" id="" rows="4" name="brief" required placeholder="Brief Description"></textarea>
                            </div>
                            <div class="col-lg-12">
                                <button type="submit">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <?php include("includes/footer.php"); ?>
    <?php include("includes/scripts.php"); ?>




</body>



</html>