<link href="../../public/style/bootstrap.css" rel="stylesheet" type="text/css" />

<div class="container-fluid">
    <div class="row">
        <div  class="col-2">
            <div class="">
            <a href="/" title="لوگو" >
                <img src="images/shortcutIcon.png" alt="لوگو فروشگاه اینترتی"  class="img-fluid my-auto"/>
                </a>
            </div>
        </div>
        <div class="col-6">
            <div class="searchBox  mt-4  mr-auto ">
                <form class="form-inline" action="/action_page.php">
                    <input class="form-control p-2 ml-2 rounded " type="search" placeholder="محصول مورد نظرتان را جستجو کنید" size="40" onFocus="">
                    <button class="btn btn-success" type="submit">جستجو</button>
                </form>
             </div>
        </div>
        <div class="col-4">
            <div class="d-flex justify-content-around align-items-center p-1 m-1">
                <div>
                    <input type="button" class="btn btn-outline-warning ml-auto " value="ورود" name="btnLogin">
                </div>
                <div class="">
                    <a href="">
                    <img src="images/bag.png" class="img-fluid " alt="سبد خرید" />
                        <span class="badge  badge-success badge-pill">
                            5
                        </span>
                    <a href="#" class="btn">سبد خرید</a>
                    </a>
                </div>

            </div>

        </div>
    </div>
</div>

<nav class="navbar navbar-expand-md navbar-light sticky-top">

	  <!-- Toggler/collapsibe Button -->
	<button  type="button" class="navbar-toggler"  data-toggle="collapse" data-target="#menu1">
    	<span class="navbar-toggler-icon"></span>
     </button>
     
     <div class="collapse navbar-collapse" id="menu1">
     
     	<!-- navbar -->
        <ul class="navbar-nav nav-pills">
        	<li class="nav-item dropdown position-static ">
            	<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="" aria-haspopup="true" aria-expanded="false" id="menu1dropdown">آرایشی</a>
                
                
                <div class="dropdown-menu dropdown-menu-right w-auto  overflow-auto mt-n2" >
                	<div class="container">
                    	<div class="row ">
                        	<div class="col-2 p-1">
                            	<h6 class="dropdown-header text-center">آرایش صورت</h6>
                                <div class="dropdown-divider"></div>
                            	<a class="dropdown-item  text-center"  href=""> آرایش صورت 1</a>
                                <a class="dropdown-item  text-center"  href=""> آرایش صورت 2</a>
                                <a class="dropdown-item   text-center"  href="">آرایش صورت 3 </a>
                                <a class="dropdown-item  text-center"   href=""> آرایش صورت 4</a>
                                <a class="dropdown-item  text-center"  href="">آرایش صورت 5 </a>
                          </div>
                            <div class="col-2 p-1">
                        	
                            	<h6 class="dropdown-header text-center">آرایش مو</h6>
                                <div class="dropdown-divider"></div>
                            	<a class="dropdown-item  text-center" data-role="category" href="">آرایش مو 1</a>
                                <a class="dropdown-item  text-center" data-role="category" href="">آرایش مو 2</a>
                                <a class="dropdown-item  text-center" data-role="category" href="">آرایش مو 3</a>
                                <a class="dropdown-item  text-center"  data-role="category" href="">آرایش مو 4</a>
                                <a class="dropdown-item  text-center" data-role="category" href="">آرایش مو 5</a>
                         
                            </div>
                            <div class="col-2 p-1">
                            
                            
                            	<h6 class="dropdown-header text-center">پوست</h6>
                                <div class="dropdown-divider"></div>
                            	<a class="dropdown-item text-center" data-role="category" href="">پوست 1</a>
                                <a class="dropdown-item  text-center" data-role="category" href="">پوست 2</a>
                                <a class="dropdown-item  text-center" data-role="category" href="">پوست 3</a>
                                <a class="dropdown-item  text-center"  data-role="category" href="">پوست 4</a>
                                <a class="dropdown-item  text-center" data-role="category" href="">پوست 5</a>
                         
                            
                            </div>
                            
                            
                            <div class="col-6  d-flex p-1">
                            
                            
                            	<img class="img-fluid my-auto" src="images/3.jpg" alt="عکس منو" />
                               
                         
                            </div>                            
                         </div>
                       </div>
                                                                                
                    </div>
               
            </li>
            
            <li class="nav-item">
            	<a class="nav-link" href="">پوست</a>
            </li>
            
            <li class="nav-item">
            	<a class="nav-link" href="">مو</a>
            </li>
            
            <li class="nav-item">
            	<a class="nav-link" href="">ادکلن</a>
            </li>
            
            <li class="nav-item">
            	<a class="nav-link" href="">ادکلن</a>
            </li>
            
            
            <li class="nav-item">
            	<a class="nav-link" href="">ادکلن</a>
            </li>
            
            <li class="nav-item">
            	<a class="nav-link" href="">ادکلن</a>
            </li>
            
            <li class="nav-item">
            	<a class="nav-link" href="">ادکلن</a>
            </li>
            
            <li class="nav-item">
            	<a class="nav-link" href="">ادکلن</a>
            </li>
            
            <li class="nav-item">
            	<a class="nav-link" href="">ادکلن</a>
            </li>
            
            <li class="nav-item">
            	<a class="nav-link" href="">ادکلن</a>
            </li>                                                                                    
        </ul>
     </div> 
</nav>


 
  <script type="text/javascript">
		
		
// code of button for go to top of page site
var speed=250;
var offset = 150;
var duration = 500;
$(window).scroll(function(){
	if ($(this).scrollTop()<offset)
	{
		$('.btndowntoup').fadeOut(duration);
	}
	else
	{
		$('.btndowntoup').fadeIn(duration);
	}
	});
	$('btndowntoup').on('click',function(){

		$('html,body').animate({scrollTop:0},speed);
		return false;
		});


new WOW().init();
 </script>