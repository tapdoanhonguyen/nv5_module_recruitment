<!-- BEGIN: main -->
<div class="swiper-container">
    <div class="swiper-wrapper">
	
	<!-- BEGIN: loop -->
      <div class="swiper-slide  tms_raogap_box">
	  <div class="tms_raogap_item">
	  <div class="company_logo">
	  <a href="{ROW.link}" title="{ROW.title}" target="_blank" ><div class="logo_box"><img class="lazy-load"  src="{ROW.jobprovider_img}" >
	  </div>
	  </a>
	  </div>
	  <div class="company_name" >
	  <div class="j_title text_ellipsis" ><a href="{ROW.link}" title="{ROW.title}" target="_blank" class="el-tooltip item" ><span ><strong >{ROW.title}</strong></span></a></div>
	  <div class="j_company text_ellipsis" ><a href="{ROW.jobprovider_url}" title="{ROW.jobprovider.title}" target="_blank" ><span >{ROW.jobprovider_title}</span></a></div>
	  
	  <div class="table-item" >
	  <div class="dollar" ><i class="fa fa-money" aria-hidden="true"></i> <!-- BEGIN: salary --> {SALARY}<!-- END: salary --></div>
	  <div class="time" ><i class="fa fa-clock-o" aria-hidden="true"></i> {ROW.addtime}</div>
	  </div>
	  </div>
	  </div>
	  </div>  
	  	<!-- END: loop -->
	  
	
    </div>
    <!-- Add Pagination -->
	
    <div class="swiper-pagination"></div>
  </div>


<!-- Swiper JS -->
  <script src="{NV_BASE_SITEURL}themes/{TEMPLATE}/thuongmaiso/swiper/js/swiper.min.js"></script>
<link rel="stylesheet" href="{NV_BASE_SITEURL}themes/{TEMPLATE}/thuongmaiso/swiper/css/swiper.min.css">

  <script>
    var swiper = new Swiper('.swiper-container', {
     
      slidesPerColumn: 3,
    
	   autoplay: {
        delay: 2500,
        disableOnInteraction: false,
      },
	  navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
	 
	   breakpoints: {
	    5000: {
		slidesPerView: 4,
		  slidesPerGroup: 4,
        },
	    2000: {
		slidesPerView: 3,
		  slidesPerGroup: 3,
        },
        1024: {
    
			slidesPerView: 3,
		  slidesPerGroup: 3,
        },
        768: {
   
		slidesPerView: 2,
		 slidesPerGroup: 2,
        },
        640: {
     
			slidesPerView: 2,
		 slidesPerGroup: 1,
        },
        450: {
			slidesPerView: 1,
		  slidesPerGroup: 1,

        }
      },
    });
  </script>


<!-- END: main -->