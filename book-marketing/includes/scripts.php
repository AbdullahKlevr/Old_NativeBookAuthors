<script src="book-marketing/assets/js/jquery.js"></script>
<script src="book-marketing/assets/js/custom.js"></script>



<div class="overlay"></div>
<div class="popupmain" id="popstatic">
    <a id="close1" class="closeico" href="javascript:;" title=""><i></i></a>
    <div class="mmpopup">

        <div class="centercont static">
            <h3><span class="fs-36 "> Book Marketing Now! </span></h3>

           <p>Set your writing career on track with <?php echo $brand;?>. </p>
        </div>
        <div class="formpop">
            <form id="" method="POST" action="/leads/">
            <input type="hidden" name="route" value="<?= $_SERVER['REQUEST_URI'] ?>">
<input type="hidden" name="brief" value="">
<input type="hidden" name="brand" value="NATIVEBOOKAUTHORS">
<input type="hidden" name="token" value="<?= $token; ?>">
<input type="hidden" name="tag" value="top-form">
<input type="hidden" name="price" value="null">
<input type="hidden" name="news" value="1">
           <input type="hidden" name="subject" value="Banner Form (nativebookauthors.com)">
                <div class="fld-input">
                    <input type="text" id="name" name="name" placeholder="Name" required="required">
                </div>
                <div class="fld-input">
                    <input type="email" id="email" name="email" placeholder="Email Address"
                        required="required">
                </div>
                <div class="fld-input">
                    <input type="number" id="phoneNum2" name="phone" placeholder="Phone Number"
                        required="required">
                    <input type="hidden" name="source" id="" value="">
                </div>
                <div class="fld-btn packageformsubmit">
                    <button type="submit LoginUp">Get Started Now </button>
                </div>
            </form>

        </div>
    </div>
</div>
<div class="popupmain" id="popdynamic">
    <a id="close1" class="closeico" href="javascript:;" title=""><i></i></a>
    <div class="mmpopup">
        <div class="centercont dynamic d-none">
            <h3><span> </span></h3>

            <p>Set your writing career on track with <?php echo $brand;?>. </p>
        </div>

        <div class="formpop">
            <form id="" method="POST" action="/leads/">
            <form id="" method="POST" action="/leads/">
            <input type="hidden" name="route" value="<?= $_SERVER['REQUEST_URI'] ?>">
<input type="hidden" name="brief" value="">
<input type="hidden" name="brand" value="NATIVEBOOKAUTHORS">
<input type="hidden" name="token" value="<?= $token; ?>">
<input type="hidden" name="tag" value="top-form">
<input type="hidden" name="price" value="null">
<input type="hidden" name="news" value="1">
           <input type="hidden" name="subject" value="Banner Form (nativebookauthors.com)">
                <div class="fld-input">
                    <input type="text" id="name" name="name" placeholder="Name" required="required">
                </div>
                <div class="fld-input">
                    <input type="email" id="email" name="email" placeholder="Email Address"
                        required="required">
                </div>
                <div class="fld-input">
                    <input type="number" id="phoneNum2" name="phone" placeholder="Phone Number"
                        required="required">
                    <input type="hidden" name="source" id="" value="">
                </div>
                <div class="fld-btn packageformsubmit">
                    <button type="submit LoginUp">Get Started Now</button>
                </div>
            </form>

        </div>
    </div>
</div>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/660c34f6a0c6737bd12778e3/1hqfqtp34';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
function setButtonURL() {
    Tawk_API.toggle();
}
</script>
<!--End of Tawk.to Script-->


