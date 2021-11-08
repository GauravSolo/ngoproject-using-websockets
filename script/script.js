var swiper = new Swiper(".mySwiper", {
    slidesPerView:1.2,
    spaceBetween:0,
    breakpoints:{
    480:{
      slidesPerView: 2,
      spaceBetween: 10,
    },
    640:{
      slidesPerView: 3,
      spaceBetween:30,
    }
  },
  freeMode: true,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },

    });

    function getoffsetTop(carditem){
      let offsettop = 0;
      while(carditem){
       offsettop += carditem.offsetTop;
       carditem = carditem.offsetParent;
      }
      return offsettop;
    }
    var card = document.querySelector("#ourteam");
    var carditems = document.querySelectorAll(".carditem");
    window.onscroll = () =>{
     carditems.forEach((carditem)=>{
      //  console.log(window.scrollY,getoffsetTop(carditem));
       if(getoffsetTop(carditem) - 253 - (window.innerHeight*3)/4 < window.scrollY)
       {
         carditem.classList.add('animcard');
         carditem.style="top:0px";
        }else{
            carditem.classList.remove('animcard');
            carditem.style= 'top:150px';
        }
      });
    }

  var scrollableheight = document.querySelector('body').scrollHeight;
 document.querySelector('.outerdiv').style = `height:${scrollableheight}px;`;


 var [signupmodal, loginmodal] = [...document.querySelectorAll('.outerdiv')];
 var [login, signup] = [...document.querySelectorAll('.logbutton')];


 login.addEventListener('click',()=>{

    loginmodal.classList.add('modal');
    signupmodal.classList.remove('modal');
 });

 signup.addEventListener('click',()=>{

    loginmodal.classList.remove('modal');
    signupmodal.classList.add('modal');
 });


 document.getElementById('sign').onclick = ()=>{
   signupmodal.classList.add('modal');
 };

 document.querySelectorAll('.btn-close').forEach((element)=>{

   element.addEventListener('click',()=>{

     element.parentElement.parentElement.parentElement.parentElement.classList.remove('modal');
   });
 });

var sm = document.getElementById('sm');
var frame = document.querySelector('.src');

    document.querySelector("button[name='signupsubmit']").onclick = (e)=>{
          // frame.classList.add('frame');
          e.preventDefault();
          // setTimeout(()=>{frame.classList.remove('frame')},2000);
          document.querySelector("button[name='signupsubmit']").innerHTML = `
          <div class="spinner-border" style="width:24px;height:24px;" role="status">
          <span class="visually-hidden" >Loading...</span>
          </div>
          <div class="ms-3" style="font-size:20px;">Loading...</div>
          `;
          
          var uname = document.querySelector("input[name='inputusername']").value;
          var umail = document.querySelector("input[name='inputemail']").value;
          var upass = document.querySelector("input[name='inputpassword']").value;
          if(!umail || !upass || !uname)
          {
              sm.innerHTML="<div class='alert alert-warning m-0' role='alert'>Please fill require input!</div>";
              setTimeout(()=>{sm.innerHTML=""},1500);

            return;
          }
          
  

          const xhr = new XMLHttpRequest();

          xhr.open('POST','signup.php',true);
          // xhr.setRequestHeader('Content-Type','multipart/formdata');
          xhr.responseType = 'json';
          xhr.onload = ()=>{
              if(xhr.status === 200)
              {
                  var res = xhr.response;
                  sm.innerHTML = res.res;
                  setTimeout(()=>{sm.innerHTML=""},1500);
                  document.querySelector("button[name='signupsubmit']").innerHTML="Submit";
                  document.querySelector("input[name='inputusername']").value = "";
                  document.querySelector("input[name='inputemail']").value = "";
                  document.querySelector("input[name='inputpassword']").value = "";
  
              }
          };
          
          const form = document.getElementById('ff');
          const formdata = new FormData(form);
         
          xhr.send(formdata);

    }        
    
      var lm = document.getElementById('lm');
      document.querySelector("button[name='loginsubmit']").onclick = (e)=>{
                    e.preventDefault();
                        document.querySelector("button[name='loginsubmit']").innerHTML = `
                        <div class="spinner-border" style="width:24px;height:24px;" role="status">
                        <span class="visually-hidden" >Loading...</span>
                        </div>
                        <div class="ms-3" style="font-size:20px;">Loading...</div>
                        `;
                  var umail = document.querySelector("input[name='inputnameemail']").value;
                  var upass = document.querySelector("input[name='inputuserpassword']").value;
                  if(!umail || !upass)
                  {
                      lm.innerHTML="<div class='alert alert-warning m-0' role='alert'>Please fill all input!</div>";
                      setTimeout(()=>{lm.innerHTML=""},1500);
                  }

                      const xhr = new XMLHttpRequest();

                      xhr.open('POST','login.php',true);
                      // xhr.setRequestHeader('Content-Type','multipart/formdata');
                      xhr.responseType = 'json';

                      xhr.onload = ()=>{
                          if(xhr.status === 200)
                          {
                              var res = xhr.response;
                              lm.innerHTML = res.res;
                              setTimeout(()=>{
                                lm.innerHTML=""
                                if(res.ok == '1')
                                  window.location.href = 'admin/index.php';
                              },1000);
                              document.querySelector("button[name='loginsubmit']").innerHTML="Log in";

                          }
                      };
                      
                      const form = document.getElementById('ll');
                      const formdata = new FormData(form);
                     
                      xhr.send(formdata);

    }



    
      document.querySelector('#targetparent').onclick = ()=>{
        var money = prompt("Enter amount");
        document.querySelector('#target').innerText = money;
        setTimeout(percentage(),1000);
      };

      (function percentage(){
        var raised = parseInt(document.querySelector('.percentage').innerText);
        var target = parseInt(document.querySelector('#target').innerText);
        document.querySelector('.progress-bar').style = `width:`+((raised*100)/target)+`%;`;
      })();

    



      var myCarousel = document.querySelector('#myCarousel');
      var carousel = new bootstrap.Carousel(myCarousel, {
        interval: 1000,
        wrap: true
      });


      let scrollToBottom = document.querySelector("#about");
      let pageBottom = document.querySelector("#footabout");

      scrollToBottom.addEventListener("click", function() {
        pageBottom.scrollIntoView()
      });


    
         
