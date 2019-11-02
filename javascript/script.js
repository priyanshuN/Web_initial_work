            function randomcolor(){
                var code='0123456789ABCDEF'.split('');
                var tone='#';
                for(var i=0;i<6;++i){
                    tone=tone+code[Math.floor(Math.random()*16)];
                }
                return tone;
            }
            var start=new Date().getTime();
            function myFunction(){
                var ran=Math.random()*300;
                var ran1=Math.random()*300;
                var ran2=Math.random()*300;
                var ran3=Math.floor(Math.random()*2);
                document.getElementById("cast").style.borderRadius=ran3*"50"+"%";
                //document.getElementById("cast").style.borderRadius=ran3*50+"%";
                document.getElementById("cast").style.backgroundColor=randomcolor();
                document.getElementById("cast").style.width=ran2+"px";
                document.getElementById("cast").style.top=ran+"px";
                document.getElementById("cast").style.left=ran1+"px";
                document.getElementById("cast").style.display="block";
                start=new Date().getTime();
            }
            function appearDelay(){
                setTimeout(myFunction,Math.random()*2000);
            }
            appearDelay();
            /*function setbgcolor(){
                $("#cast").css("background-color", randomcolor());
            }*/
            document.getElementById("cast").onclick=function(){
                //setbgcolor();
                document.getElementById("cast").style.display="none";
                /*document.getElementById("cast").css("background-color", randomcolor())*/;
                var end=new Date().getTime();
                var timeTaken=(end-start)/1000;
                document.getElementById("time").innerHTML=timeTaken+"s";
                appearDelay();
            }