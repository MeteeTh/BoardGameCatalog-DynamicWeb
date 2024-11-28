"use strict";function GSPB_render_Swiper(e){let t=parseFloat(e.dataset.slidesperview),s=parseFloat(e.dataset.slidesperviewmd),a=parseFloat(e.dataset.slidesperviewsm),r=parseFloat(e.dataset.slidesperviewxs),o=parseFloat(e.dataset.slidespergroup)||1,l=parseFloat(e.dataset.slidespergroupmd),n=parseFloat(e.dataset.slidespergroupsm),d=parseFloat(e.dataset.slidespergroupxs),c=parseInt(e.dataset.spacebetween),p=parseInt(e.dataset.spacebetweenmd),u=parseInt(e.dataset.spacebetweensm),f=parseInt(e.dataset.spacebetweenxs),w=parseInt(e.dataset.speed),g=JSON.parse(e.dataset.loop),v=JSON.parse(e.dataset.autoheight),y=JSON.parse(e.dataset.grabcursor),b=JSON.parse(e.dataset.freemode),h=e.dataset.keyboard,m=e.dataset.onlyinviewport,x=e.dataset.mousewheel,S=e.dataset.forcetoaxis,$=e.dataset.releaseonedges,k=e.dataset.freemodesticky,q=JSON.parse(e.dataset.vertical),_=JSON.parse(e.dataset.centered),E=JSON.parse(e.dataset.autoplay),L=e.dataset.autoplayrestore,T=e.dataset.disablepause,I=e.dataset.stoponlastslide,P=e.dataset.reversedirection,B=e.dataset.watchoverflow,C=e.dataset.clickablebullets,A=e.dataset.clicktoslide,G=e.dataset.disablefinger,O=e.dataset.disablemove,Y=e.dataset.parallax,N=parseInt(e.dataset.autodelay),V=e.dataset.pagecurrentindex;1==N&&(N=0);let M=e.dataset.effect,X=parseInt(e.dataset.coverflowrotate),Z=parseInt(e.dataset.coverflowdepth),z=JSON.parse(e.dataset.coverflowshadow),D=e.dataset.customparams?JSON.parse(e.dataset.customparams):"",H="",F="",j=e.closest(".gs-slider-root");j||(j=e.closest(".gspb_row")),j&&(H=j.querySelector(".gs-slider-custom-btn-right"),F=j.querySelector(".gs-slider-custom-btn-left"));let J=e.dataset.syncedcontainer,K=992,Q=768,R=576;"undefined"!=typeof gs_swiper?(K=parseInt(gs_swiper.breakpoints.desktop)||992,Q=parseInt(gs_swiper.breakpoints.tablet)||768,R=parseInt(gs_swiper.breakpoints.mobile)||576):"undefined"!=typeof gs_swiper_params&&(K=parseInt(gs_swiper_params.breakpoints.desktop)||992,Q=parseInt(gs_swiper_params.breakpoints.tablet)||768,R=parseInt(gs_swiper_params.breakpoints.mobile)||576);let U={spaceBetween:c,slidesPerView:t,slidesPerGroup:o,speed:w,loop:g,autoHeight:v,direction:q?"vertical":"horizontal",grabCursor:y,freeMode:!!b&&{sticky:k||!1,enabled:!0},keyboard:!!h&&{onlyInViewport:m||!1},mousewheel:!!x&&{forceToAxis:S||!1,releaseOnEdges:$||!1},centeredSlides:_,slideToClickedSlide:A,watchOverflow:!!B,autoplay:!!E&&{delay:N,pauseOnMouseEnter:!T,disableOnInteraction:!L,stopOnLastSlide:!!I,reverseDirection:!!P},effect:"coverflow"==M||"creative"==M||"cards"==M?M:null,coverflowEffect:"coverflow"==M?{rotate:X,slideShadows:z,depth:Z}:null,creativeEffect:"creative"==M?{prev:{translate:[D.prev.translateX,D.prev.translateY,D.prev.translateZ],rotate:[D.prev.rotateX,D.prev.rotateY,D.prev.rotateZ],opacity:D.prev.opacity,scale:D.prev.scale,shadow:D.prev.shadow,origin:D.prev.origin},next:{translate:[D.next.translateX,D.next.translateY,D.next.translateZ],rotate:[D.next.rotateX,D.next.rotateY,D.next.rotateZ],opacity:D.next.opacity,scale:D.next.scale,shadow:D.next.shadow,origin:D.next.origin},perspective:!0}:null,breakpoints:{},on:{slideChange:function(e){let t=e.el,s=t.closest(".gs-slider-root");if(s||(s=t.closest(".gspb_row")),s){let a=s.querySelectorAll(".gs-slider-control-btn");Array.prototype.forEach.call(a,function(e){e.classList.remove("active")});let r=e.activeIndex+1,o=s.querySelectorAll(".gs-slideto-"+r);Array.prototype.forEach.call(o,function(e){e.classList.add("active")})}if(V){let l=document.querySelector(V);null!=l&&(l.innerHTML=e.realIndex+1)}if(J&&"."!=J&&"#"!=J){let n=document.querySelectorAll(J);n.length>0&&Array.prototype.forEach.call(n,function(t){let s=t.children;if(s.length>0){Array.prototype.forEach.call(s,function(e){e.classList.remove("active")});let a=(s=Array.from(s).filter(e=>"STYLE"!==e.tagName))[e.realIndex];a&&(a.classList.add("active"),a.classList.contains("gs-accordion-item")&&!a.classList.contains("gsopen")&&"function"==typeof GSPB_Accordion_Toggle)&&GSPB_Accordion_Toggle(a.querySelector(".gs-accordion-item__title"))}})}}},pagination:{el:e.querySelector(".swiper-pagination"),type:"bullets",clickable:C},navigation:{nextEl:H||e.querySelector(".swiper-button-next"),prevEl:F||e.querySelector(".swiper-button-prev")},scrollbar:{el:e.querySelector(".swiper-scrollbar"),draggable:!0}};G&&(U.followFinger=!1),O&&(U.allowTouchMove=!1),Y&&(U.parallax=!0);e.querySelector(".swiper-slide[data-hash]")&&(U.hashNavigation={watchState:!0}),U.breakpoints[236]={slidesPerView:r||t,spaceBetween:f||c,slidesPerGroup:d||o},U.breakpoints[R]={slidesPerView:a||t,spaceBetween:u||c,slidesPerGroup:n||o},U.breakpoints[Q]={slidesPerView:s||t,spaceBetween:p||c,slidesPerGroup:l||o},U.breakpoints[K]={spaceBetween:c,slidesPerView:t,slidesPerGroup:o},new Swiper(e.querySelector(".swiper:not(.swiper-initialized)"),U)}var gcswiperinits=document.getElementsByClassName("gs-swiper-init");for(let i=0;i<gcswiperinits.length;i++)GSPB_render_Swiper(gcswiperinits[i]);for(let i=0;i<gcswiperinits.length;i++){let e=gcswiperinits[i],t=e.dataset.syncedslider,s=e.dataset.syncedsliderboth;if(t){let a=e.querySelector(".swiper").swiper,r=document.querySelector(t);if(null!==r){let o=JSON.parse(e.dataset.loop),l=JSON.parse(r.querySelector(".gs-swiper-init").dataset.loop),n=r.querySelector(".swiper");if(null!==n){let d=n.swiper;void 0!==d&&(a.on("slideChange",function(){!o&&l?d.slideToLoop(a.activeIndex,500,!1):o&&!l?d.slideTo(a.realIndex,500,!1):o&&l?d.slideToLoop(a.realIndex,500,!1):d.slideTo(a.activeIndex,500,!1)}),s&&d.on("slideChange",function(){!o&&l?a.slideTo(d.realIndex,500,!1):o&&!l?a.slideToLoop(d.activeIndex,500,!1):o&&l?a.slideToLoop(d.realIndex,500,!1):a.slideTo(d.activeIndex,500,!1)}))}}}let c=e.dataset.syncedcontainer;if(c&&"."!=c&&"#"!=c){let p=document.querySelectorAll(c);if(p.length>0){let u=e.querySelector(".swiper").swiper,f=JSON.parse(e.dataset.loop);Array.prototype.forEach.call(p,function(e){let t=e.children;t.length>0&&(t=Array.from(t).filter(e=>"STYLE"!==e.tagName),Array.prototype.forEach.call(t,function(s){s.addEventListener("click",function(a){e.classList.contains("gs-accordion")&&(a.preventDefault(),a.stopPropagation());let r=Array.prototype.indexOf.call(t,s);f?u.slideToLoop(parseInt(r)):u.slideTo(parseInt(r))})}))})}}}let gspbslidercustom=document.getElementsByClassName("gs-slider-control-btn");for(let i=0;i<gspbslidercustom.length;i++){let w=gspbslidercustom[i],g=w.closest(".gs-slider-root");if(g||(g=w.closest(".gspb_row")),g){let v=g.querySelector(".swiper");if(v){let y=v.swiper,b=w.getAttribute("class").match(/gs-slideto-([0-9]+)/)[1];w.addEventListener("click",function(e){y.slideTo(parseInt(b)-1)})}}}