<?php 
    $url = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    
    //for title
    $tit['default'] = 'Ebook Writing Services | Professional Book Writing Services';
    $tit['about-us/'] = 'Exceptional Writing Services - Native Book Authors';
    $tit['book-cover-service/'] = 'Professional Book cover design Services by Nativebookauthor';
    $tit['book-marketing-services/'] = 'Get our Book Marketing Services and Increase Your Sales by 10X';
    $tit['contact-us/'] = 'Boost Your Success with the Best Book Publishing Service';
    $tit['editing-service/'] = 'Best Book Editing Services get 50% Off by Nativebookauthors.com';
    $tit['publishing-service/'] = 'Book Publishing Services in Affordable Price | Nativebookauthors';
    
    $title =  !empty($tit[basename($url)]) ? $tit[basename($url)] : $tit['default'];
    
    
    //for description
    $desc['default'] = 'Elevate your vision to words with professional book writing services. Expert authors bring your story to life. Your literary journey starts here!';
    $desc['about-us/'] = 'Native Book Authors is your dedicated partner in the literary journey. With Exceptional Writing Services, we turn your ideas into compelling narratives.';
    $desc['book-cover-service/'] = 'Our Designers Design your Book cover with 100% creativity and uniqueness so dont waste your time and get our book cover design services.';
    $desc['book-marketing-services/'] = 'We have Book marketing Experts who will increase your sales so dont miss this opportunity and get our book marketing services.';
    $desc['contact-us/'] = 'Elevate your writing journey with the best book publishing service. Maximize your success and receive expert author support. Your path to greatness begins here!';
    $desc['editing-service/'] = 'Get up to 40% Discount on our book and ebook editing services our expert team provide quality services in affordable prices Visit Nativebookauthors.';
    $desc['publishing-service/'] = 'If you want to publish your book with up to 50% discount then feel free to get our book publishing services we provide high quality services.';
    
    
    $description =  !empty($desc[basename($url)]) ? $desc[basename($url)] : $desc['default'];
  
  
  //for canonical
    $can['default'] = '<link rel="canonical" href="https://nativebookauthors.com/>';
    $can['about-us/'] = '<link rel="canonical" href="https://nativebookauthors.com/about-us/>';
    $can['book-cover-service/'] = '<link rel="canonical" href="https://nativebookauthors.com/book-cover-service//>';
    $can['book-marketing-services/'] = '<link rel="canonical" href="https://nativebookauthors.com/book-marketing-services//>';
    $can['contact-us/'] = '<link rel="canonical" href="https://nativebookauthors.com/contact-us//>';
    $can['editing-service/'] = '<link rel="canonical" href="https://nativebookauthors.com/editing-service//>';
    $can['ebook-writing/'] = '<link rel="canonical" href="https://nativebookauthors.com/ebook-writing/>';
    $can['publishing-service/'] = '<link rel="canonical" href="https://nativebookauthors.com/publishing-service//>';
    
    $canonical =  !empty($can[basename($url)]) ? $can[basename($url)] : $can['default'];
    
?>