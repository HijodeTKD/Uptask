const darkModeBtn=document.querySelector("#darkmode-toggle"),bgColorFromToDiv=document.querySelector("#bgcolorfromto"),body=document.body;function checkFirstVisitPrefers(){localStorage.noFirstVisit||window.matchMedia&&window.matchMedia("(prefers-color-scheme: dark)").matches&&(darkModeBtn&&(darkModeBtn.checked=!0,body.classList.add("skip-anim")),body.classList.add("darkmode"),bgColorFromToDiv.classList.add("fromdarktodark"),localStorage.noFirstVisit="1",window.localStorage.setItem("preferDark",1))}function checkUserPrefers(){"1"===window.localStorage.getItem("preferDark")&&(bgColorFromToDiv.classList.add("fromdarktodark"),body.classList.add("darkmode"),darkModeBtn&&(darkModeBtn.checked=!0,body.classList.add("skip-anim")))}checkFirstVisitPrefers(),checkUserPrefers(),darkModeBtn.addEventListener("change",(function(){body.classList.contains("skip-anim")&&body.classList.remove("skip-anim"),body.classList.toggle("darkmode"),bgColorFromToDiv.classList.toggle("fromdarktodark"),body.classList.contains("darkmode")?window.localStorage.setItem("preferDark",1):window.localStorage.setItem("preferDark",0)}));